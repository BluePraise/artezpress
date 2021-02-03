const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
var formatDate = function(timestamp) {
    var date = new Date(timestamp);
    return date.getDate() + " " + monthNames[date.getMonth()] + " " + date.getFullYear();
}

// console.log(artez_object.post_id);

const fetchPost = ({
    api = artez_object.site_url + '/wp-json/wp/v2/posts/' + artez_object.post_id,
} = {}) => {

    // console.log(api);
    let product_api = artez_object.site_url + '/wp-json/wp/v2/product/';
    let postContent = document.querySelector('#artez-single-post');
    let preloader = document.querySelector('.news-preloader');
    var pfeatured_img = "";
    // Private Methods
    const loadContent = function() {

        // Basic query parameters to filter the API
        // Visit https://developer.wordpress.org/rest-api/reference/posts/#arguments
        // For information about other parameters
        const params = {
            _embed: true, // Required to fetch images, author, etc
        }

        // console.log('_embed', params._embed);

        // Builds the API URL with params _embed
        const getApiUrl = (url) => {
            let apiUrl = new URL(url);
            apiUrl.search = new URLSearchParams(params).toString();
            return apiUrl;
        };

        // Make a request to the REST API
        const loadPost = async() => {
            const url = getApiUrl(api);
            const request = await fetch(url);

            if (request.status == 200) {
                const post = await request.json();
                // Builds the HTML to show the posts
                const postsHtml = renderPostHtml(post);
                // Adds the HTML into the posts div
                postContent.innerHTML = postsHtml;
                // Required for the infinite scroll
                preloader.style.visibility = 'hidden';
            } else {
                preloader.style.visibility = 'hidden';
            }

        };

        // Builds the HTML to show all posts
        const renderPostHtml = (post) => {
            let postHtml = '';

            postHtml = postTemplate(post);

            return postHtml;

        };


        // HTML template for a post
        const postTemplate = (post) => {
            let p_src = post._embedded['wp:featuredmedia'];
            let acf_src = post.acf.post_building_modules;

            if (typeof(p_src) != "undefined") {


                var featured_img = ` <img src="${post._embedded['wp:featuredmedia'][0]['media_details']['sizes']['large'].source_url}" class="post-thumbnail news-portrait" />`;


            } else {
                var featured_img = '';
            }


            var acf_blocks = "";
            if (acf_src != null) {

                for (let block of acf_src) {

                    if (block.acf_fc_layout == "news_content_module") {
                        // console.log(block.news_content);
                        acf_blocks += '<div class="news-text news-module-container">' + block.news_content + '</div>';
                    } else if (block.acf_fc_layout == "video_module") {

                        if (block.video_url) {
                            acf_blocks += '<div class="video-container news-module-container">' +
                                block.video_url;
                            if (block.video_caption) {
                                acf_blocks += '<figcaption class="news-video-caption">' + block.video_caption + '</figcaption>';
                            }
                            acf_blocks += '</div>';
                        }
                    } else if (block.acf_fc_layout == "book_reference_module") {
                        let purl = getApiUrl(product_api + '' + block.book_reference["ID"]);
                        let pfeatured_img;
                        const loadProduct = async() => {
                            try {
                                let purl = getApiUrl(product_api + '' + block.book_reference["ID"]);
                                let prequest = await fetch(purl);
                                // console.log(prequest);
                                if (prequest.status == 200) {

                                    let product = await prequest.json();
                                    let product_src = await product._embedded['wp:featuredmedia'];
                                    if (typeof(product_src) != "undefined") {
                                        pfeatured_img = await product._embedded['wp:featuredmedia'][0]['media_details']['sizes']['full'].source_url;
                                        return pfeatured_img;
                                    }

                                }
                            } catch (e) {
                                // handle error
                                console.error(e)
                            }

                        }

                        loadProduct().then(() => {


                            })
                            //const pfeatured_img_src = ` <img src="${pf_img}" class="" />`;


                        acf_blocks += ` <div class="book-reference news-module-container">
                            <figure></figure>
                    <h5>${block.book_reference["post_title"]}</h5>
                    <div class="content-container">
                        
                        <p>   ${block.book_reference_description} </p>
                        
                        <a class="news-read-more" href="${block.book_reference["guid"]}" alt="go to ${block.book_reference["post_title"]}">Read More</a>
                    </div>
                </div>`;

                    }


                    // news_cotent = news_cotent.replace(/<[^>]*>?/gm, '');
                }
            }


            post.feat_img = featured_img;

            return ` <figure class="news-thumbnail">    ${post.feat_img} </figure>
            <div class="content-container"> <p class="news-date">${formatDate(post.date)}</p>
            <h3 class="news-title">${post.title.rendered}</h3>
            </div><div class="news-content__single">
              
              <div class="news-text news-module-container">${acf_blocks} </div>
              
             </div>
           `;
        };

        loadPost();

    };


    // Public Properties and Methods
    // return {
    //     init: loadContent
    // };
    if (postContent) {
        return loadContent();
    }

};

fetchPost();
const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
var formatDate = function(timestamp) {
    var date = new Date(timestamp);
    return date.getDate() + " " + monthNames[date.getMonth()] + " " + date.getFullYear();
}


const fetchPosts = ({
    api = artez_object.site_url + '/wp-json/wp/v2/posts',
    startPage = 0,
    postsPerPage = 10,
    idk = 'idk'
} = {}) => {

    // console.log(api);
    // console.log(startPage);
    // console.log(postsPerPage);

    let postsLoaded = false;
    let postsContent = document.querySelector('#news-json-grid');
    let btnLoadMore = document.querySelector('.btn-load-more');
    let preloader = document.querySelector('.news-preloader');
    let allLoaded = document.querySelector('.posts-loaded');

    // Private Methods
    const loadContent = function() {

        // Starts with page = 1
        // Increase every time content is loaded
        ++startPage;

        // Basic query parameters to filter the API
        // Visit https://developer.wordpress.org/rest-api/reference/posts/#arguments
        // For information about other parameters
        const params = {
            _embed: true, // Required to fetch images, author, etc
            page: startPage, // Current page of the collection
            per_page: postsPerPage, // Maximum number of posts to be returned by the API
        }

        // console.log('_embed', params._embed);
        // console.log('per_page', params.per_page);
        // console.log('page', params.page);

        // Builds the API URL with params _embed, per_page, and page
        const getApiUrl = (url) => {
            let apiUrl = new URL(url);
            apiUrl.search = new URLSearchParams(params).toString();
            return apiUrl;
        };

        // Make a request to the REST API
        const loadPosts = async() => {


            const url = getApiUrl(api);
            const request = await fetch(url);
            //console.log(request.headers.get('X-WP-TotalPages'));
            if (request.status == 200) {
                const posts = await request.json();


                // Builds the HTML to show the posts
                const postsHtml = renderPostHtml(posts);
                // Adds the HTML into the posts div
                postsContent.innerHTML += postsHtml;
                // Required for the infinite scroll
                postsLoaded = true;
                preloader.style.visibility = 'hidden';
            } else {
                preloader.style.visibility = 'hidden';
                btnLoadMore.style.visibility = 'hidden';
                allLoaded.style.visibility = 'visible';

            }

        };

        // Builds the HTML to show all posts
        const renderPostHtml = (posts) => {
            let postHtml = '';
            for (let post of posts) {
                postHtml += postTemplate(post);
            };
            return postHtml;

        };


        // HTML template for a post
        const postTemplate = (post) => {
            let p_src = post._embedded['wp:featuredmedia'];
            let acf_src = post.acf.post_building_modules;

            if (typeof(p_src) != "undefined") {
                var width = parseInt(post._embedded['wp:featuredmedia'][0]['media_details']['width']);
                var height = parseInt(post._embedded['wp:featuredmedia'][0]['media_details']['height']);
                if (width < height) {
                    var featured_img = ` <img src="${post._embedded['wp:featuredmedia'][0]['media_details']['sizes']['news-portrait'].source_url}" class="post-thumbnail news-portrait" />`;
                } else {
                    var featured_img = ` <img src="${post._embedded['wp:featuredmedia'][0].source_url}" class="post-thumbnail" />`;
                }

            } else {
                var featured_img = '';
            }

            if (acf_src != null) {
                var news_cotent = acf_src[0].news_content;
                // news_cotent = news_cotent.replace(/<[^>]*>?/gm, '');
            } else {
                var news_cotent = "";
            }


            post.feat_img = featured_img;

            return `
            <div id="post-${post.id}" class="news-item">
            <div class="news-date-excerpt">${formatDate(post.date)}</div>
            <figure class="news-thumbnail">    ${post.feat_img} </figure>
             <h4 class="news-title news-title-excerpt">${post.title.rendered}</h4> 
              <p class="news-item-excerpt">${news_cotent}</p>
              <a class="news-read-more" href="${post.link}" title="${post.title.rendered}" role="link">Read More</a>
            </div>`;
        };

        loadPosts();

    };

    // Where the magic happens
    // Checks if IntersectionObserver is supported
    // if ('IntersectionObserver' in window) {

    //     const loadMoreCallback = (entries, observer) => {
    //         entries.forEach((btn) => {
    //             if (btn.isIntersecting && postsLoaded === true) {
    //                 postsLoaded = false;
    //                 loadContent();
    //             }
    //         });
    //     };

    //     // Intersection Observer options
    //     const options = {
    //         threshold: 1.0 // Execute when button is 100% visible
    //     };

    //     let loadMoreObserver = new IntersectionObserver(loadMoreCallback, options);
    //     loadMoreObserver.observe(btnLoadMore);
    // }



    btnLoadMore.addEventListener('click', () => {
        postsLoaded = false;
        preloader.style.visibility = 'visible';
        loadContent();
        return false;
    });

    // Public Properties and Methods
    // return {
    //     init: loadContent
    // };
    return loadContent();

};

fetchPosts();
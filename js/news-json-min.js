const monthNames=["January","February","March","April","May","June","July","August","September","October","November","December"];var formatDate=function(e){var t=new Date(e);return t.getDate()+" "+monthNames[t.getMonth()]+" "+t.getFullYear()};const fetchPosts=({api:e=artez_object.site_url+"/wp-json/wp/v2/posts",startPage:t=0,postsPerPage:s=10,idk:i="idk"}={})=>{let r=!1,a=document.querySelector("#news-json-grid"),n=document.querySelector(".btn-load-more"),d=document.querySelector(".news-preloader"),l=document.querySelector(".posts-loaded");const o=function(){var i=new Masonry(a,{itemSelector:".news-item",transitionDuration:0});const o={_embed:!0,page:++t,per_page:s},c=e=>{let t="";for(let s of e)t+=m(s);return t},m=e=>{let t=e._embedded["wp:featuredmedia"],s=e.acf.post_building_modules;if(void 0!==t)if(parseInt(e._embedded["wp:featuredmedia"][0].media_details.width)<parseInt(e._embedded["wp:featuredmedia"][0].media_details.height))var i=` <img src="${e._embedded["wp:featuredmedia"][0].media_details.sizes["news-portrait"].source_url}" class="post-thumbnail news-portrait" />`;else i=` <img src="${e._embedded["wp:featuredmedia"][0].source_url}" class="post-thumbnail" />`;else i="";if(null!=s)var r=s[0].news_content;else r="";return e.feat_img=i,`\n            <div id="post-${e.id}" class="news-item">\n            <div class="news-date-excerpt">${formatDate(e.date)}</div>\n            <figure class="news-thumbnail">    ${e.feat_img} </figure>\n             <h4 class="news-title news-title-excerpt">${e.title.rendered}</h4> \n              <p class="news-item-excerpt">${r}</p>\n              <a class="news-read-more" href="${e.link}" title="${e.title.rendered}" role="link">Read More</a>\n            </div>`};(async()=>{const t=(e=>{let t=new URL(e);return t.search=new URLSearchParams(o).toString(),t})(e),s=await fetch(t);if(200==s.status){const e=await s.json(),t=c(e);a.innerHTML+=t,r=!0,i.reloadItems(),imagesLoaded(a).on("progress",(function(){i.layout()})),d.style.visibility="hidden"}else d.style.visibility="hidden",n.style.visibility="hidden",l.style.visibility="visible"})(),r=!0};if(n&&n.addEventListener("click",(()=>(r=!1,d.style.visibility="visible",o(),!1))),a)return o()};fetchPosts();
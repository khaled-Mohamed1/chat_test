// PADDING TOP IN MOBILE
window.onload = function(){
  setPaddinglocalStorage();
  window.ondeviceorientation = function(){
    setPaddinglocalStorage();
  }
  window.onresize = function(){
    setPaddinglocalStorage();
  }
}
function setPaddinglocalStorage(){
  if(window.innerWidth <= 767.9){
    localStorage.setItem('body-padding-top', 'true');
  }else{
    localStorage.setItem('body-padding-top', 'false')
  }
}

// ACTIVE LINK background-color
let links = document.querySelectorAll('.nav.flex-column .nav-link');

links.forEach(function(el){
  el.addEventListener('click', function(){
    if(this.id === 'logout'){
      return false;
    }
    links.forEach((e)=>{
      e.classList.remove('active');
    });
    el.classList.add('active');
  });
});

// DIRECTING SIDEBAR LINKS
sidebarLinks('#reports-link', 'http://127.0.0.1:8000/admin/dashboard/reports');
sidebarLinks('#users-link', 'http://127.0.0.1:8000/admin/dashboard/users');
sidebarLinks('#admins-link', 'http://127.0.0.1:8000/admin/dashboard/admins');
sidebarLinks('#companies-link', 'http://127.0.0.1:8000/admin/dashboard/companies');

function sidebarLinks(id, dest){
  document.querySelector(id).addEventListener('click', function(){
    document.querySelector('iframe').setAttribute('src', `${dest}`);
    if(document.body.offsetWidth <= 767.9){
      document.querySelector('.navbar-toggler').click();
    }
  });
}
// toggle compressed
document.querySelector('.btn-compressed').addEventListener('click', function(){
  document.querySelector('#sidebarMenu').classList.toggle('compressed');
});

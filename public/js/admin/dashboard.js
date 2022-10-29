function toggleSidebar(e){
    e.classList.toggle('open');
    document.getElementById("sidebar").classList.toggle('active');
    document.getElementById("main").classList.toggle('active');
}
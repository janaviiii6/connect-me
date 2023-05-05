<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
      integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
      crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin=""></script>
<style>
:root{
    --primary-txt-color: #3E6CFF;
    --bg-color: #F8F9FE;
    --secondary-txt-color:#888B93;
    --active-status-color: #5FDBA7;
}
.text-white{
    color: white;
}
{{--Universal classes--}}
.active-status-color{
    color: var(--active-status-color);
}
body{
    font-family: 'Raleway', sans-serif;
    background-color: var(--bg-color);
}
.nav-link{
    color: white;
}
.btn-map-modal,
.btn-submit{
    width: auto;
    height: 53px;
    color: var(--primary-txt-color);
    border-color: var(--primary-txt-color);
}
.home-btn a{
    width: 167px;
    height: 53px;
    color: var(--primary-txt-color);
    border-radius: 100px;
    border-color: var(--primary-txt-color);
}
.home-btn a:hover,
.btn-submit:hover,
.btn-map-modal:hover{
    color: white;
    background: var(--primary-txt-color);
}
.mt-10{
    margin-top: 100px;
}
a{
    text-decoration: none!important;
}
{{--Welcome page classes--}}
.home-page{
    position: relative;
    top: 100px;
}
.home-page img{
    width: 730px;
    height: 500px;
    position: absolute;
    top: 86px;
    z-index: 999;
}
.btn-circle {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #007bff;
  color: #fff;
  border: none;
}

.btn-circle:hover {
  background-color: #0062cc;
}
.home-btn{
    padding-top: 40px;
}
.content{
    padding-top: 30px;
}
.title{
    font-size: 60px;
    font-weight: 500;
    color: var(--primary-txt-color);
}
.description{
    font-size: 24px;
    font-weight: 500;
    width: 700px;
    color: var(--secondary-txt-color);
}
.wave {
    position: relative;
    top: 140px;
    z-index: 99;
}
{{--User dashboard classes--}}
.navbar-bg-color{
    background-color: var(--primary-txt-color);
    opacity: 0.6;
}
.navbar-brand{
    font-size: 31px;
    color: white;
}
.user-notifications i{
    width: 18px;
    height: 20px;
}
.user-card{
    position: relative;
    width: 500px;
    height: 219px;
    border: none;
    background: none;
    border-radius: 12px;
}
.user-image img{
    width: 38px;
    height: 39px;
    border-radius: 100px;
}
.user-card-user-image img{
    border-radius: 100%;
    width: 76px;
    height: 76px;
}
.bg-user-card-color{
    position: absolute;
    top: 171px;
    width: 500px;
    height: 219px;
    background-color: var(--primary-txt-color);
    opacity: 0.1;
    border-radius: 12px;
}
.user-card-body .user-name{
    font-size: 31px;
    color: var(--primary-txt-color);
    font-weight: 500;
}
.user-card-body .user-status{
    font-size: 18px;
}
.user-ride-form-details{
    font-size: 20px;
    font-weight: 500;
    color: var(--primary-txt-color);
    opacity: 0.5;
}
.user-info {
    background-color: #f2f2f2;
    padding: 20px;
}

/* User Dashboard */
.user-card {
    margin-bottom: 24px;
    box-shadow: 0 2px 3px #e4e8f0;
}
.user-card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #eff0f2;
    border-radius: 1rem;
}
.avatar-md {
    height: 4rem;
    width: 4rem;
}
.rounded-circle {
    border-radius: 50%!important;
}
.img-thumbnail {
    padding: 0.25rem;
    background-color: #f1f3f7;
    border: 1px solid #eff0f2;
    border-radius: 0.75rem;
}
.avatar-title {
    align-items: center;
    background-color: #3b76e1;
    color: #fff;
    display: flex;
    font-weight: 500;
    height: 100%;
    justify-content: center;
    width: 100%;
}
.bg-soft-primary {
    background-color: rgba(59,118,225,.25)!important;
}
.badge-soft-danger {
    color: #f56e6e !important;
    background-color: rgba(245,110,110,.1);
}
.badge-soft-success {
    color: #63ad6f !important;
    background-color: rgba(99,173,111,.1);
}
.mb-0 {
    margin-bottom: 0!important;
}
.badge {
    display: inline-block;
    padding: 0.25em 0.6em;
    font-size: 75%;
    font-weight: 500;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.75rem;
}
/* #user-details-column{
    width: 100%;
    height: auto;
} */
#ride-cards {
    height: 100%;
    overflow-y: auto;
}

.card {
    margin-bottom: 10px;
}

/*  USer Ride Detials  */
.user-ride-form-details{
    margin-left: 50px;
}
.user-destination input,
.host .total_fare input,.wait-time input{
    border-radius: 100px;
    border-color: transparent;
    background: #e9ecef;
    color: #1f2937;
    width: 400px;
}

.host .is_host input{
    border-radius: 100px;
}
.host .is_host label{
    padding-left: 1rem;
    color: #343a40;
}
.user-ride-btn{
    width: 200px;
    padding-left: 150px;
}
.user-ride-btn button{
    border-radius: 100px;
    height: 40px;
}
/* Navabr */
.navbar-nav .nav-link,
.navbar-nav .nav-link i,
.navbar-nav .nav-item button,
{
    color: white;
}
.home-btn a{
    padding-top: 14px;
}



</style>

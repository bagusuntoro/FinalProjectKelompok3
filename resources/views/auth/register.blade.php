
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{asset('admin-lte/plugins/fontawesome-free/css/all.min.css')}}">

  <!-- incon title -->
  <link rel="icon" href="{{asset('admin-lte/dist/img/inosof.png')}}">

<link rel="stylesheet" href="{{asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('admin-lte/dist/css/adminlte.min.css?v=3.2.0')}}">
<script nonce="f3843a73-ea46-4bb2-9825-34345c5494f8">(function(w,d){!function(eK,eL,eM,eN){eK.zarazData=eK.zarazData||{};eK.zarazData.executed=[];eK.zaraz={deferred:[],listeners:[]};eK.zaraz.q=[];eK.zaraz._f=function(eO){return function(){var eP=Array.prototype.slice.call(arguments);eK.zaraz.q.push({m:eO,a:eP})}};for(const eQ of["track","set","debug"])eK.zaraz[eQ]=eK.zaraz._f(eQ);eK.zaraz.init=()=>{var eR=eL.getElementsByTagName(eN)[0],eS=eL.createElement(eN),eT=eL.getElementsByTagName("title")[0];eT&&(eK.zarazData.t=eL.getElementsByTagName("title")[0].text);eK.zarazData.x=Math.random();eK.zarazData.w=eK.screen.width;eK.zarazData.h=eK.screen.height;eK.zarazData.j=eK.innerHeight;eK.zarazData.e=eK.innerWidth;eK.zarazData.l=eK.location.href;eK.zarazData.r=eL.referrer;eK.zarazData.k=eK.screen.colorDepth;eK.zarazData.n=eL.characterSet;eK.zarazData.o=(new Date).getTimezoneOffset();if(eK.dataLayer)for(const eX of Object.entries(Object.entries(dataLayer).reduce(((eY,eZ)=>({...eY[1],...eZ[1]})))))zaraz.set(eX[0],eX[1],{scope:"page"});eK.zarazData.q=[];for(;eK.zaraz.q.length;){const e_=eK.zaraz.q.shift();eK.zarazData.q.push(e_)}eS.defer=!0;for(const fa of[localStorage,sessionStorage])Object.keys(fa||{}).filter((fc=>fc.startsWith("_zaraz_"))).forEach((fb=>{try{eK.zarazData["z_"+fb.slice(7)]=JSON.parse(fa.getItem(fb))}catch{eK.zarazData["z_"+fb.slice(7)]=fa.getItem(fb)}}));eS.referrerPolicy="origin";eS.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(eK.zarazData)));eR.parentNode.insertBefore(eS,eR)};["complete","interactive"].includes(eL.readyState)?zaraz.init():eK.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head>
<body class="hold-transition register-page">
<div class="register-box">
<div class="register-logo">
<a href="../../index2.html"><b>tube</b>Stream</a>
</div>
<div class="card">
<div class="card-body register-card-body">
<p class="login-box-msg">Register a new membership</p>
<form>
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Full name">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-user"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="email" class="form-control" placeholder="Email">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" class="form-control" placeholder="Password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" class="form-control" placeholder="Retype password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="agreeTerms" name="terms" value="agree">
<label for="agreeTerms">
I agree to the <a href="#">terms</a>
</label>
</div>
</div>

<div class="col-4">
<a href="/">
<button type="button" class="btn btn-primary btn-block">Register</button>
</a>
</div>

</div>
</form>
<div class="social-auth-links text-center">
<p>- OR -</p>
<a href="#" class="btn btn-block btn-primary">
<i class="fab fa-facebook mr-2"></i>
Sign up using Facebook
</a>
<a href="#" class="btn btn-block btn-danger">
<i class="fab fa-google-plus mr-2"></i>
Sign up using Google+
</a>
</div>
<a href="/" class="text-center">I already have a membership</a>
</div>

</div>
</div>


<script src="../../plugins/jquery/jquery.min.js"></script>

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>

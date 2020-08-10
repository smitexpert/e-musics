
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>SolMusic | HTML Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="SolMusic HTML Template">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('website') }}/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="{{ asset('website') }}/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="{{ asset('website') }}/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="{{ asset('website') }}/css/slicknav.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{ asset('website') }}/css/style.css"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
		<!-- Header section -->
		<header class="header-section clearfix">
			<a href="/" class="site-logo">
				@if (\App\SiteSetting::where('name', 'logo')->first())
					<img src="{{ asset('uploads/logo') }}/{{ \App\SiteSetting::where('name', 'logo')->first()->value }}" alt="">
				@else
					<img src="{{ asset('website') }}/img/logo.png" alt="">
				@endif
			</a>
			<div class="header-right">
				<div class="user-panel">
					@if (Auth::user())
						@if (Auth::user()->type == 'admin')
							<a href="{{ route('dashboard') }}" class="register">Dashboard</a>
						@else
							<a href="{{ route('user.login') }}" class="login">Accounts</a>
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit()" class="register">Logout</a>
							<form action="{{ route('logout') }}" method="POST" id="logout">
								@csrf
							</form>
						@endif
					@else
						<a href="{{ route('user.login') }}" class="login">Login</a>
						<a href="{{ route('user.register') }}" class="register">Create an account</a>
					@endif
				</div> 
			</div>
			<ul class="main-menu">
				<li><a href="{{ route('browse') }}">Browse Music</a></li>
				<li><a href="{{ route('album') }}">Albums</a></li>
				<li><a href="#">Genres</a></li>
			</ul>
		</header>
		<!-- Header section end -->






        <section class="songs-section">
            <div class="container">
                <!-- song -->
                <div class="song-item">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="song-info-box">
                                <img src="website/img/songs/1.jpg" alt="">
                                <div class="song-info">
                                    <h4>Jennifer Brown</h4>
                                    <p>One Night in Ibiza</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single_player_container">
                                <div class="single_player">
                                    <div class="clierfix wavePlayer">
                                        <div class="audiowave container_1" data-container=".container_1" data-waveurl="website/music-files/8.mp3"></div>
                                        <div class="currentTime"></div>
                                        <div class="clipTime"></div>
                                        <!-- Player Controls -->
                                        <div class="wavePlayer_controls">
                                            <button class="jp-prev player_button" onclick="wavesurfer.skipBackward();"></button>
                                            <button class="jp-play player_button" onclick="wavesurfer.playPause();"></button>
                                            <button class="jp-next player_button" onclick="wavesurfer.skipForward();"></button>
                                            <button class="jp-stop player_button" onclick="wavesurfer.stop();"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="songs-links">
                                <a href=""><img src="website/img/icons/p-1.png" alt=""></a>
                                <a href=""><img src="website/img/icons/p-2.png" alt=""></a>
                                <a href=""><img src="website/img/icons/p-3.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- song -->
                <div class="song-item">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="song-info-box">
                                <img src="website/img/songs/1.jpg" alt="">
                                <div class="song-info">
                                    <h4>Jennifer Brown</h4>
                                    <p>One Night in Ibiza</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single_player_container">
                                <div class="single_player">
                                    <div class="clierfix wavePlayer">
                                        <div class="audiowave container_2" data-container=".container_2" data-waveurl="website/music-files/8.mp3"></div>
                                        <div class="currentTime"></div>
                                        <div class="clipTime"></div>
                                        <!-- Player Controls -->
                                        <div class="wavePlayer_controls">
                                            <button class="jp-prev player_button" onclick="wavesurfer.skipBackward();"></button>
                                            <button class="jp-play player_button" onclick="wavesurfer.playPause();"></button>
                                            <button class="jp-next player_button" onclick="wavesurfer.skipForward();"></button>
                                            <button class="jp-stop player_button" onclick="wavesurfer.stop();"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="songs-links">
                                <a href=""><img src="website/img/icons/p-1.png" alt=""></a>
                                <a href=""><img src="website/img/icons/p-2.png" alt=""></a>
                                <a href=""><img src="website/img/icons/p-3.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- song -->
                <div class="song-item">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="song-info-box">
                                <img src="website/img/songs/1.jpg" alt="">
                                <div class="song-info">
                                    <h4>Jennifer Brown</h4>
                                    <p>One Night in Ibiza</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single_player_container">
                                <div class="single_player">
                                    <div class="clierfix wavePlayer">
                                        <div class="audiowave container_3" data-container=".container_3" data-waveurl="website/music-files/8.mp3"></div>
                                        <div class="currentTime"></div>
                                        <div class="clipTime"></div>
                                        <!-- Player Controls -->
                                        <div class="wavePlayer_controls">
                                            <button class="jp-prev player_button" onclick="wavesurfer.skipBackward();"></button>
                                            <button class="jp-play player_button"></button>
                                            <button class="jp-next player_button" onclick="wavesurfer.skipForward();"></button>
                                            <button class="jp-stop player_button" onclick="wavesurfer.stop();"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="songs-links">
                                <a href=""><img src="website/img/icons/p-1.png" alt=""></a>
                                <a href=""><img src="website/img/icons/p-2.png" alt=""></a>
                                <a href=""><img src="website/img/icons/p-3.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- Songs section end -->







	

	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-lg-7 order-lg-2">
					<div class="row">
						<div class="col-sm-4">
							{{-- <div class="footer-widget">
								<h2>About us</h2>
								<ul>
									<li><a href="">Our Story</a></li>
									<li><a href="">Sol Music Blog</a></li>
									<li><a href="">History</a></li>
								</ul>
							</div> --}}
						</div>
						<div class="col-sm-4">
							{{-- <div class="footer-widget">
								<h2>Products</h2>
								<ul>
									<li><a href="">Music</a></li>
									<li><a href="">Subscription</a></li>
									<li><a href="">Custom Music</a></li>
									<li><a href="">Footage</a></li>
								</ul>
							</div> --}}
						</div>
						<div class="col-sm-4">
							<div class="footer-widget">
								<h2>Playlists</h2>
								<ul>
									<li><a href="">Newsletter</a></li>
									<li><a href="">Careers</a></li>
									<li><a href="">Press</a></li>
									<li><a href="">Contact</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-5 order-lg-1">
					@if (\App\SiteSetting::where('name', 'logo')->first())
						<img src="{{ asset('uploads/logo') }}/{{ \App\SiteSetting::where('name', 'logo')->first()->value }}" alt="">
					@else
						<img src="{{ asset('website') }}/img/logo.png" alt="">
					@endif
					<div class="copyright">
						@if (\App\SiteSetting::where('name', 'copyright')->first())
							{!! \App\SiteSetting::where('name', 'copyright')->first()->value !!}
						@else
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
						@endif
					</div>
					
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer section end -->
	
	<!--====== Javascripts & Jquery ======-->
	<script src="{{ asset('website') }}/js/jquery-3.2.1.min.js"></script>
	<script src="{{ asset('website') }}/js/bootstrap.min.js"></script>
	<script src="{{ asset('website') }}/js/jquery.slicknav.min.js"></script>
	<script src="{{ asset('website') }}/js/owl.carousel.min.js"></script>
	<script src="{{ asset('website') }}/js/mixitup.min.js"></script>
	<script src="{{ asset('website') }}/js/main.js"></script>

	<!-- Audio Players js -->
	<script src="{{ asset('website') }}/js/jquery.jplayer.min.js"></script>
	<script src="{{ asset('website') }}/js/wavesurfer.min.js"></script>

	<!-- Audio Players Initialization -->
	{{-- <script src="{{ asset('website') }}/js/WaveSurferInit.js"></script> --}}
    {{-- <script src="{{ asset('website') }}/js/jplayerInit.js"></script> --}}
    
    <script type="text/javascript">
        // jPlayer Initialization


    // WaveSurfer Initialization



var players = $(".audiowave");

// var wavesurfer;

players.each(function(e){
    var player = $(this);

    var wavesurfer = WaveSurfer.create({
        container: player.data('container'),
        waveColor: '#d0d7db',
        progressColor: '#9ca1a4',
        barWidth: 2,
        barGap: 1,
        cursor:false,
        cursorWidth: 0,
        height: 80,
        barHeight: 0.7,
    });
    
    wavesurferInit(wavesurfer);
    
    function wavesurferInit(wavesurfer) {
        var trackID = player;
        var songURL = player.data('waveurl');
        wavesurfer.load(songURL);
    
        function formatSecondsAsTime(secs) {
            var hr  = Math.floor(secs / 3600);
            var min = Math.floor((secs - (hr * 3600))/60);
            var sec = Math.floor(secs - (hr * 3600) -  (min * 60));
    
            if (min < 10){ 
                min = "0" + min; 
            }
            if (sec < 10){ 
                sec  = "0" + sec;
            }
            return min + ':' + sec;
        }
    
    
        $(document).ready(function($){
            player.closest('.wavePlayer').find('.currentTime').appendTo('wave wave');
        });
    
        wavesurfer.on('audioprocess', function () {
            var clipCurrentTime = wavesurfer.getCurrentTime();
            // console.log(player.find('.currentTime'));
            player.closest('.wavePlayer').find('.currentTime').html(formatSecondsAsTime(clipCurrentTime));
            // document.getElementsByClassName('currentTime').innerHTML = formatSecondsAsTime(clipCurrentTime);
        });
    
        wavesurfer.on('ready', function () {
            var clipTime = wavesurfer.getDuration();
            
            player.closest('.wavePlayer').find('.clipTime').html(formatSecondsAsTime(clipTime));
            // document.getElementsByClassName('clipTime').innerHTML = formatSecondsAsTime(clipTime);
        });
    
        wavesurfer.on('interaction', function () {
            var clipCurrentTime = wavesurfer.getCurrentTime();
            player.closest('.wavePlayer').find('.currentTime').html(formatSecondsAsTime(clipCurrentTime));
            // document.getElementsByClassName('currentTime').innerHTML = formatSecondsAsTime(clipCurrentTime);
        });

    
        console.log(wavesurfer)
    
        wavesurfer.on('play', function () {
            // $(document).ready(function () {
            //     // $('.player-box').addClass('playing');
            //     $('.jplayer').jPlayer("pauseOthers");
            //     player.closest('.wavePlayer').find('.player-box').addClass('playing');
            //     player.closest('.wavePlayer').find('.jplayer').jPlayer("pauseOthers");
            // });
            console.log('Action');
        });

        player.closest('.wavePlayer').find('.jp-play').click(function(){
            wavesurfer.playPause();
        });

        player.closest('.wavePlayer').find('.jp-next').click(function(){
            wavesurfer.skipForward();
        });

        player.closest('.wavePlayer').find('.jp-prev').click(function(){
            wavesurfer.skipBackward();
        });

        player.closest('.wavePlayer').find('.jp-stop').click(function(){
            wavesurfer.stop();
        });
        
    
        wavesurfer.on('pause', function () {
            $(document).ready(function () {
                $('.player-box').removeClass('playing');
            });
        });

        // wavesurfer.on('play', function () {
        //     $(document).ready(function () {
        //         $('.player-box').addClass('playing');
        //         $('.jplayer').jPlayer("pauseOthers");
        //     });
        // });
    
        // wavesurfer.on('pause', function () {
        //     $(document).ready(function () {
        //         $('.player-box').removeClass('playing');
        //     });
        // });
    }
})





    </script>

	</body>
</html>

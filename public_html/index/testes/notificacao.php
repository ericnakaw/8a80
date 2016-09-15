<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bootstrap Notify v3.1.3</title>

	<!-- Core Cascading Style Sheets -->
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

	<link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/tomorrow-night-eighties.min.css" rel="stylesheet">

	<!-- Custom Cascading Style Sheets -->
	<link href="css/icomoon.css" rel="stylesheet">
	<link href="css/titatoggle.min.css" rel="stylesheet">
	<link href="css/app.css" rel="stylesheet">

	<style>
		.animated {
			-webkit-animation-iteration-count: infinite;
			animation-iteration-count: infinite;
		}
	</style>

	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body data-spy="scroll" data-target="nav" data-offset="72">

	<div class="[ visible-xs ]">
		<nav class="[ navbar navbar-default ]">
			<div>
				<ul class="[ nav navbar-nav ]">
					<li class="[ navbar-link twitter ]"><a href="#twitter"><span class="[ fa fa-twitter ]"></span> *</a></li>
					<li class="[ navbar-link facebook ]"><a href="#facebook"><span class="[ fa fa-facebook ]"></span> *</a></li>
					<li class="[ navbar-link google-plus ]"><a href="#googleplus"><span class="[ fa fa-google-plus ]"></span> *</a></li>
					<li class="[ navbar-link github ]"><a href="#githubstars"><span class="[ fa fa-star ]"> *</span></a></li>
				</ul>
			</div>
		</nav>
	</div>

	<nav class="[ navbar navbar-default navbar-fixed-top ]">
		<div class="[ container ]">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="[ navbar-header ]">
				<button type="button" class="[ navbar-toggle collapsed ]" data-toggle="collapse" data-target="#main-navbar">
					<span class="[ sr-only ]">Toggle navigation</span>
					<span class="[ icon-bar ]"></span>
					<span class="[ icon-bar ]"></span>
					<span class="[ icon-bar ]"></span>
				</button>
				<a class="[ navbar-brand visible-xs ][ jump-to ]" href="#bootstrap-notify" style="left:-1000px;">Bootstrap Notify</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="[ collapse navbar-collapse ]" id="main-navbar">
				<ul class="[ nav navbar-nav ][  hidden-xs ]">
					<li class="[ navbar-link twitter ]"><a href="#twitter" data-text="Check out #BootstrapNotify jQuery Plugin By Remable Designs" data-url="http://bootstrap-notify.remabledesigns.com/" data-via="mouse0270"><span class="[ fa fa-twitter ]"></span> *</a></li>
					<li class="[ navbar-link facebook ]"><a href="#facebook"><span class="[ fa fa-facebook ]"></span> *</a></li>
					<li class="[ navbar-link google-plus ]"><a href="#googleplus"><span class="[ fa fa-google-plus ]"></span> *</a></li>
					<li class="[ navbar-link github ]"><a href="#githubstars"><span class="[ fa fa-star ]"> *</span></a></li>
				</ul>
				<ul class="[ nav navbar-nav navbar-right ]">
					<li><a class="[ jump-to ][ hide ]" href="#bootstrap-notify"><span class="[ fa fa-chevron-up ]"></span><span class="[ sr-only ]">Bootstrap Notify</span></a></li>
					<li><a class="[ jump-to ]" href="#demo">Demo</a></li>
					<li class="[ dropdown ]">
						<a class="[  ][ jump-to ]" href="#documentation">Documentation</a>						
						<ul class="[ dropdown-menu ][ bounceInDown ]" role="menu">
							<li><a class="[ jump-to ]" href="#documentation-custom-css">Custom CSS</a></li>
							<li><a class="[ jump-to ]" href="#documentation-how-to-use">How to Use</a></li>
							<li><a class="[ jump-to ]" href="#documentation-options">Options</a></li>
							<li><a class="[ jump-to ]" href="#documentation-settings">Settings</a></li>
							<li><a class="[ jump-to ]" href="#documentation-default-template">Default Template</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="[ jump-to ]" href="#methods">Methods</a>
						<ul class="dropdown-menu" role="menu">
							<li><a class="[ jump-to ]" href="#methods-update">Update</a></li>
							<li><a class="[ jump-to ]" href="#methods-close">Close</a></li>
							<li><a class="[ jump-to ]" href="#methods-setting-defaults">Setting Defaults</a></li>
							<li><a class="[ jump-to ]" href="#methods-close-all">Close All</a></li>
						</ul>
					</li>
					<li><a class="[ jump-to ]" href="#examples">Examples</a></li>
					<li><a href="https://github.com/mouse0270/bootstrap-notify" target="_blank">Download</a></li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	
	<section id="bootstrap-notify" class="[ container ]">
		<div class="[ col-xs-12 col-lg-offset-1 col-lg-10 ]">
			<h1>Bootstrap Notify</h1>
			<p class="[ lead ]">This plugin helps to turn standard bootstrap alerts into "growl" like notifications.</p>

			<header><span class="[ sr-only ]">Header Image Displaying Bootstrap Notify messages</span></header>

			<p>Bootstrap Notify formally known as Bootstrap notify was renamed at version 3.0.0. This project originally started out to be a pull request for <a href="https://github.com/ifightcrime/bootstrap-notify" target="_blank">ifightcrime's Bootstrap notify</a> plugin, but quickly grew into it's own. This is the reason the two plugins shared a name and I chose that it was time that my plugin got its own name.</p>
			<p>Please keep in mind that with this new version of Bootstrap Notify formally known as Bootstrap Growl that you will not be able to just drop it into your project and go. When ever I do a big update such as going from version 2.x to 3.x that it is a complete rewrite with new features and better support. This means you will have to review your project before updating this project. Another important update is since version 3.x you no longer call the plugin using <code>$.growl(...)</code> you must use <code>$.notify(...)</code>.</p>

			<h1 id="demo">Demo</h1>
			<form method="post" action="#GenerateNotify">
				<div class="[ row ]">
					<div class="[ col-xs-12 col-sm-6 ][ demo-notify-position ]" data-toggle="buttons">
						<button class="[ btn btn-orange ]">
							<input type="radio" name="position" autocomplete="off" value="top-left" /><span class="[ icon-arrow-up-left ]"></span>
						</button><button class="[ btn ][ btn-orange ]">
							<input type="radio" name="position" autocomplete="off" value="top-center" /><span class="[ icon-arrow-up ]"></span>
						</button><button class="[ btn ][ btn-orange ] active">
							<input type="radio" name="position" autocomplete="off" value="top-right" checked="" /><span class="[ icon-arrow-up-right ]"></span>
						</button><button class="[ btn ][ btn-orange ]">
							<input type="radio" name="position" autocomplete="off" value="bottom-left" /><span class="[ icon-arrow-down-left ]"></span>
						</button><button class="[ btn ][ btn-orange ]">
							<input type="radio" name="position" autocomplete="off" value="bottom-center" /><span class="[ icon-arrow-down ]"></span>
						</button><button class="[ btn ][ btn-orange ]">
							<input type="radio" name="position" autocomplete="off" value="bottom-right" /><span class="[ icon-arrow-down-right ]"></span>
						</button>
					</div>

					<div class="[ col-xs-12 col-sm-6 ]">
						<div class="[ row ]">
							<div class="[ col-xs-12 col-sm-6 ]">
								<label>Allow Dismiss</label>
								<div class="checkbox checkbox-slider--b checkbox-slider-lg">
									<label>
										<input type="checkbox" id="demo-allow-dismiss" name="demo-allow-dismiss" checked><span><span class="[ sr-only ]">Allow Dismiss</span></span>
									</label>
								</div>
							</div>
							<div class="[ col-xs-12 col-sm-6 ]">
								<label>Pause on Hover</label>
								<div class="checkbox checkbox-slider--b checkbox-slider-lg">
									<label>
										<input type="checkbox" id="demo-pause-on-hover" name="demo-pause-on-hover"><span><span class="[ sr-only ]">Pause on Hover</span></span>
									</label>
								</div>
							</div>
						</div>

						<div class="[ row ]">
							<div class="[ col-xs-12 col-sm-6 ]">
								<label>Newest on Top</label>
								<div class="checkbox checkbox-slider--b checkbox-slider-lg">
									<label>
										<input type="checkbox" id="demo-newest-on-top" name="demo-newest-on-top"><span><span class="[ sr-only ]">Newest on Top</span></span>
									</label>
								</div>
							</div>

							<div class="[ col-xs-12 col-sm-6 ]">
								<div class="[ form-group ]">
									<label for="#">Spacing</label>
									<input type="number" id="demo-spacing" class="[ form-control ]" value="10" min="0" />
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="[ row ]">
					<div class="[ col-xs-12 col-sm-3 ]">
						<div class="[ form-group ]">
							<label for="#">Offset X Axis</label>
							<input type="number" id="demo-offset-x-axis" class="[ form-control ]" value="20" min="0" />
						</div>
					</div>

					<div class="[ col-xs-12 col-sm-3 ]">
						<div class="[ form-group ]">
							<label for="#">Offset Y Axis</label>
							<input type="number" id="demo-offset-y-axis" class="[ form-control ]" value="20" min="0" />
						</div>
					</div>

					<div class="[ col-xs-12 col-sm-3 ]">
						<div class="[ form-group ]">
							<label for="#">Delay</label>
							<input type="number" id="demo-delay" class="[ form-control ]" value="5000" min="0" step="100" />
						</div>
					</div>

					<div class="[ col-xs-12 col-sm-3 ]">
						<div class="[ form-group ]">
							<label for="#">Z-Index</label>
							<input type="number" id="demo-z-index" class="[ form-control ]" value="1031" min="0" />
						</div>
					</div>
				</div>

				<div class="[ row ]">
					<div class="[ col-xs-12 col-sm-3 ]">
						<div class="[ btn-group-vertical ][ btn-full-width ]" role="group" data-toggle="buttons">
							<button type="button" class="[ btn btn-success ]"><input type="radio" name="type" autocomplete="off" value="success" /> Success</button>
							<button type="button" class="[ btn btn-info ] active"><input type="radio" name="type" autocomplete="off" value="info" checked /> Info</button>
							<button type="button" class="[ btn btn-warning ]"><input type="radio" name="type" autocomplete="off" value="warning" /> Warning</button>
							<button type="button" class="[ btn btn-danger ]"><input type="radio" name="type" autocomplete="off" value="danger" /> Danger</button>
						</div>
					</div>

					<div class="[ col-xs-12 col-sm-9 ]">
						<div class="[ alert alert-info ]" role="alert">
							<strong>Icon:</strong> <span data-notify="icon" contenteditable="true">glyphicon glyphicon-warning-sign</span><br/>
							<strong>Title:</strong> <span data-notify="title" contenteditable="true">Bootstrap Notify</span><br/>
							<strong>Message:</strong> <span data-notify="message" contenteditable="true">Turning standard Bootstrap alerts into "Growl-like" notifications</span><br/>
							<strong>URL:</strong> <span data-notify="url" contenteditable="true">https://github.com/mouse0270/bootstrap-notify</span><br/>
							<strong>Target:</strong> <span data-notify="target" contenteditable="true">_blank</span><br/>
						</div>
					</div>
				</div>

				<div class="[ row ]">
					<div class="[ col-xs-12 col-sm-offset-4 col-sm-4 ]">
						<button class="[ btn ][ btn-orange btn-full-width ]">Generate Notify</button>
					</div>
				</div>
			<form>

			<h1 id="documentation">Documentation</h1>
			<p>Please make sure to read the documenation it exlains how to use this plugin and points out common mistakes people tend to make. It will also give you examples on how to use this plugin.</p>

			<p>If you are having any issues using this plugin please feel free to ask me on <a href="https://gitter.im/mouse0270/bootstrap-notify?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge" target="_blank">gitter</a>. I must admit it is a wonderful site for quick questions about github plugins that may not actually be issues. Please feel free to make improvements by forking the plugin and making a <a href="https://github.com/mouse0270/bootstrap-notify/pulls" target="_blank">pull request</a>. Lastly, if you do find an issue with the plugin please report it on the github <a href="https://github.com/mouse0270/bootstrap-notify/issues" target="_blank">issues</a> page.

			<h2 id="documentation-custom-css">Custom CSS <small>Not Included</small></h2>
			<p>Yes, my plugin relies on custom css for its intro and exit animations. For this I recommend using this wonderful resource called <a href="http://daneden.github.io/animate.css/" target="_blank">Animate.css</a> by <a href="http://daneden.me/" target="_blank">Daniel Eden</a>. He has put together a wonderful set of css animations that work perfectly with this plugin.</p>
			<p>The most important one is probably going to be the progress bar. You will have to include that css if you would like the progress bars to look like the ones displayed on this page.</p>
			<div class="pre-container" data-type="Cascade Style Sheet">
				[data-notify="progressbar"] {
					margin-bottom: 0px;
					position: absolute;
					bottom: 0px;
					left: 0px;
					width: 100%;
					height: 5px;
				}
			</div>
		
			<h2 id="documentation-how-to-use">Do not do the following</h2>
			<p>This is wrong when using this plugin. I have tried to make Bootstrap Notify as flexible I could think by including both <code>options</code> and <code>settings</code>.</p>

			<div class="pre-container testing" data-type="JavaScript">
				$('body').notify({
					message: 'Hello World',
					type: 'danger'
				});
			</div>

			<h2>Instead do this</h2>
			<p>Below is an example showing all the correct way to use Bootstrap Notify.</p>

			<div class="pre-container testing" data-type="JavaScript">
				$.notify({
					// options
					message: 'Hello World' 
				},{
					// settings
					type: 'danger'
				});
			</div>
	
			<h2>Full list of <code>options</code>/<code>settings</code></h2>
			<p>Below is a list of all the <code>options</code> and <code>settings</code> you are able to use and which each section belongs to.</p>

			<div class="pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					// options
					icon: 'glyphicon glyphicon-warning-sign',
					title: 'Bootstrap notify',
					message: 'Turning standard Bootstrap alerts into "notify" like notifications',
					url: 'https://github.com/mouse0270/bootstrap-notify',
					target: '_blank'
				},{
					// settings
					element: 'body',
					position: null,
					type: "info",
					allow_dismiss: true,
					newest_on_top: false,
					showProgressbar: false,
					placement: {
						from: "top",
						align: "right"
					},
					offset: 20,
					spacing: 10,
					z_index: 1031,
					delay: 5000,
					timer: 1000,
					url_target: '_blank',
					mouse_over: null,
					animate: {
						enter: 'animated fadeInDown',
						exit: 'animated fadeOutUp'
					},
					onShow: null,
					onShown: null,
					onClose: null,
					onClosed: null,
					icon_type: 'class',
					template: '&lt;div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
						'&lt;button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;&lt;/button>' +
						'&lt;span data-notify="icon">&lt;/span> ' +
						'&lt;span data-notify="title">{1}&lt;/span> ' +
						'&lt;span data-notify="message">{2}&lt;/span>' +
						'&lt;div class="progress" data-notify="progressbar">' +
							'&lt;div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">&lt;/div>' +
						'&lt;/div>' +
						'&lt;a href="{3}" target="{4}" data-notify="url">&lt;/a>' +
					'&lt;/div>' 
				});
			</div>

			<h2 id="documentation-options">Options</h2>
			<table class="[ col-xs-12 table-bordered table-condensed ]">
				<thead>
					<tr>
						<th>Name</th>
						<th>Type / Values</th>
						<th>Required</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td data-title="Code">icon</td>
						<td data-title="Type / Values"><em>class</em> | <em>src</em></td>
						<td data-title="Required"><code>No</code></td>
						<td data-title="Description">This is the icon that will be displayed within the notify notification. This icon can either be a class (Font Icon) or an image url. Please keep in mind if you wish to use an image url that you must set icon_type to img in the options.</td>
					</tr>
					<tr>
						<td data-title="Code">title</td>
						<td data-title="Type / Values"><em>string</em></td>
						<td data-title="Required"><code>No</code></td>
						<td data-title="Description">This is the title that will be displayed within the notify notification. Please keep in mind unless you style the [data-notify="title"] in css this will look identical to the message.</td>
					</tr>
					<tr>
						<td data-title="Code">message</td>
						<td data-title="Type / Values"><em>string</em></td>
						<td data-title="Required"><code>Yes</code></td>
						<td data-title="Description">This is the message that will be displayed within the notify notification.</td>
					</tr>
					<tr>
						<td data-title="Code">url</td>
						<td data-title="Type / Values"><em>web address</em></td>
						<td data-title="Required"><code>No</code></td>
						<td data-title="Description">If this value is set it will make the entire notify (except the close button) a clickable area. If the user clicks on this area it will take them to the url specified here.</td>
					</tr>
					<tr>
						<td data-title="Code">target</td>
						<td data-title="Type / Values"><em>_blank</em> | <em>_self</em> | <em>_parent</em> | <em>_top</em></td>
						<td data-title="Required"><code>no</code></td>
						<td data-title="Description">The target attribute specifies where to open the linked notification.</td>
					</tr>
				</tbody>
			</table>

			<div class="[ clearfix ]"></div>

			<h2 id="documentation-settings">Settings</h2>
			<table class="[ col-xs-12 table-bordered table-condensed ]">
				<thead>
					<tr>
						<th>Name</th>
						<th>Type / Values</th>
						<th>Default</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td data-title="Code">element</td>
						<td data-title="Type / Values"><em>string</em></td>
						<td data-title="Default"><code>body</code></td>
						<td data-title="Description">Appends the notification to a specific element. If the element is set to anything other than the body of a document it switches from a position: fixed to position: absolute.</td>
					</tr>
					<tr>
						<td data-title="Code">position</td>
						<td data-title="Type / Values"><em>static</em> | <em>fixed</em> | <em>relative</em> | <em>absolute</em> | <em><code>null</code></em></td>
						<td data-title="Default"><code>null</code></td>
						<td data-title="Description">Allows users to specify a custom position to the notification container element.</td>
					</tr>
					<tr>
						<td data-title="Code">type</td>
						<td data-title="Type / Values"><em>string</em></td>
						<td data-title="Default"><code>info</code></td>
						<td data-title="Description">Defines the style of the notification using bootstraps native alert styles. Please keep in mind that when the notification is generated the type gets prefixed with alert-. When using native alert styles this will not be an issue, but if you create a new style such as pink when setting up the css you have to use the class <code>alert-pink</code>.</td>
					</tr>
					<tr>
						<td data-title="Code">allow_dismiss</td>
						<td data-title="Type / Values"><em>boolean</em></td>
						<td data-title="Default"><code>true</code></td>
						<td data-title="Description">If this value is set to false it will hide the <code>data-grow="dismiss"</code> element. Please keep in mind if you modify the <code>template</code> setting and do not include a <code>data-notify="dismiss"</code> element even with this set to true there will be no element for a user to click to close the notification.</td>
					</tr>
					<tr>
						<td data-title="Code">showProgressbar</td>
						<td data-title="Type / Values"><em>boolean</em></td>
						<td data-title="Default"><code>false</code></td>
						<td data-title="Description">This <code>boolean</code> is used to determine if the notification should display a progress bar.</td>
					</tr>
					<tr>
						<td data-title="Code">placement.from</td>
						<td data-title="Type / Values"><em>string</em></td>
						<td data-title="Default"><code>top</code></td>
						<td data-title="Description">This controls where if the notification will be placed at the <code>top</code> or <code>bottom</code> of your element.</td>
					</tr>
					<tr>
						<td data-title="Code">placement.align</td>
						<td data-title="Type / Values"><em>string</em></td>
						<td data-title="Default"><code>right</code></td>
						<td data-title="Description">This controls if the notification will be placed in the <code>left</code>, <code>center</code> or <code>right</code> side of the element.</td>
					</tr>
					<tr>
						<td data-title="Code">offset</td>
						<td data-title="Type / Values"><em>integer</em></td>
						<td data-title="Default"><code>20</code></td>
						<td data-title="Description">This adds padding in <code>pixels</code> between the element and the notification creating a space between their edges.</td>
					</tr>
					<tr>
						<td data-title="Code">offset.x</td>
						<td data-title="Type / Values"><em>integer</em></td>
						<td data-title="Default"><code>20</code></td>
						<td data-title="Description">This adds adding on the <code>x</code> axis in <code>pixels</code> between the element and the notification creating a space between their edges.</td>
					</tr>
					<tr>
						<td data-title="Code">offset.y</td>
						<td data-title="Type / Values"><em>integer</em></td>
						<td data-title="Default"><code>20</code></td>
						<td data-title="Description">This adds padding on the <code>y</code> axis in <code>pixels</code> between the element and the notification creating a space between their edges.</td>
					</tr>
					<tr>
						<td data-title="Code">spacing</td>
						<td data-title="Type / Values"><em>integer</em></td>
						<td data-title="Default"><code>10</code></td>
						<td data-title="Description">This adds a padding in <code>pixels</code> between notifications with the same placement creating a space between their edges.</td>
					</tr>
					<tr>
						<td data-title="Code">z_index</td>
						<td data-title="Type / Values"><em>integer</em></td>
						<td data-title="Default"><code>1031</code></td>
						<td data-title="Description">Pretty simple, this sets the css property <code>z-index</code> for the notification. You may have to raise this number if you have other elements overlapping the notification.</td>
					</tr>
					<tr>
						<td data-title="Code">delay</td>
						<td data-title="Type / Values"><em>integer</em></td>
						<td data-title="Default"><code>5000</code></td>
						<td data-title="Description">If <code>delay</code> is set higher than <code>0</code> then the notification will auto-close after the <code>delay</code> period is up. Please keep in mind that delay uses milliseconds so <code>5000</code> is <code>5</code> seconds.</td>
					</tr>
					<tr>
						<td data-title="Code">timer</td>
						<td data-title="Type / Values"><em>integer</em></td>
						<td data-title="Default"><code>1000</code></td>
						<td data-title="Description">This is the amount of milliseconds removed from the notify at every <code>timer</code> milliseconds. So to make that a little less confusing every <code>1000 milliseconds</code> there will be <code>1000 milliseconds</code> removed from the remaining time of the notify delay. If this is set higher then delay the notify will not be removed until timer has run out.</td>
					</tr>
					<tr>
						<td data-title="Code">url_target</td>
						<td data-title="Type / Values"><em>_blank</em> | <em>_self</em> | <em>_parent</em> | <em>_top</em></td>
						<td data-title="Default"><code>'_blank'</code></td>
						<td data-title="Description">This sets the target of the url for a notification. please check <code>HTML &lt;a&gt; target Attribute</code> to learn more about these options.</td>
					</tr>
					<tr>
						<td data-title="Code">mouse_over</td>
						<td data-title="Type / Values"><em>pause</em> | <em><code>null</code></em></td>
						<td data-title="Default"><code>null</code></td>
						<td data-title="Description">By default this does nothing. If you set this option to pause it will <code>pause</code> the timer on the notification delay. Since version 2.0.0 the timer will not reset it will continue from it's last tick.</td>
					</tr>
					<tr>
						<td data-title="Code">animate.enter</td>
						<td data-title="Type / Values">string</td>
						<td data-title="Default"><code>animated fadeInDown</code></td>
						<td data-title="Description">This will control the animation used to bring the generate the notification on screen. Since version 2.0.0 all animations are controlled using css. This plugin is not com packaged with any animations. Please use <a href="http://daneden.github.io/animate.css/" target="_blank">Animate.css</a> by <a href="http://daneden.me/" target="_blank">Daniel Eden</a> or you can always write your own css animations.</td>
					</tr>
					<tr>
						<td data-title="Code">animate.exit</td>
						<td data-title="Type / Values">string</td>
						<td data-title="Default"><code>animated fadeOutUp</code></td>
						<td data-title="Description">This will control the animation used to bring the generate the notification on screen. Since version 2.0.0 all animations are controlled using css. This plugin is not com packaged with any animations. Please use <a href="http://daneden.github.io/animate.css/" target="_blank">Animate.css</a> by <a href="http://daneden.me/" target="_blank">Daniel Eden</a> or you can always write your own css animations.</td>
					</tr>
					<tr>
						<td data-title="Code">onShow</td>
						<td data-title="Type / Values">function</td>
						<td data-title="Default"><code>null</code></td>
						<td data-title="Description">This event fires immediately when the <code>show</code> instance method is called.</td>
					</tr>
					<tr>
						<td data-title="Code">onShow</td>
						<td data-title="Type / Values">function</td>
						<td data-title="Default"><code>null</code></td>
						<td data-title="Description">This event is fired when the modal has been made visible to the user (will wait for CSS transitions to complete).</td>
					</tr>
					<tr>
						<td data-title="Code">onClose</td>
						<td data-title="Type / Values">function</td>
						<td data-title="Default"><code>null</code></td>
						<td data-title="Description">This event is fired immediately when the notification is <code>closing</code>.</td>
					</tr>
					<tr>
						<td data-title="Code">onClosed</td>
						<td data-title="Type / Values">function</td>
						<td data-title="Default"><code>null</code></td>
						<td data-title="Description">his event is fired when the modal has finished closing and is removed from the document (will wait for CSS transitions to complete).</td>
					</tr>
					<tr>
						<td data-title="Code">icon_type</td>
						<td data-title="Type / Values">string</td>
						<td data-title="Default"><code>class</code></td>
						<td data-title="Description">This is used to let the plugin know if you are using an <code>icon font</code> for images or if you are using <code>image</code>. If this setting is not set to <code>class</code> it will assume you are using an <code>img</code>. Please keep in mind if you are using an <code>image</code> you to set <code>icon</code> to the <code>src</code> of the <code>image</code>.</td>
					</tr>
					<tr>
						<td data-title="Code">template</td>
						<td data-title="Type / Values">HTML</td>
						<td data-title="Default"><code>code below</code></td>
						<td data-title="Description">Since version 3.0.0 the template option has been revamped in hopes of giving users more control over the layout. Please find the code for the default template below.</td>
					</tr>
				</tbody>
			</table>

			<div class="[ clearfix ]"></div>

			<h2 id="documentation-default-template">Default Template Setup</h2>
			<p>Bootrstrap Notify uses data attributes (<em><code>data-notify</code></em>) to place content with in the notification template.</p>
			<ul>
				<li><code>container</code>: Container of notification element</li>
				<li><code>dismiss</code>: Element used to allow user to manually close notification</li>
				<li><code>icon</code>: Either has a class for an icon image or will generate an html image tag</li>
				<li><code>title</code>: Element that the notification will insert the title</li>
				<li><code>message</code>: Element that the notification will insert the message</li>
				<li><code>progressbar</code>: Element used to show progress bar.</li>
				<li><code>url</code>: Element that will have href set if a url is passed.</li>
			</ul>
			<p>In version 3+ the  <code>template setting</code> was modified to use a combination of data attributes and a <a href="https://msdn.microsoft.com/en-us/library/system.string.format(v=vs.110).aspx" target="_blank">C# string.format</a> like function to control the content within the notification.</p>
			<ul>
				<li><code>{0}</code> = type</li>
				<li><code>{1}</code> = title</li>
				<li><code>{2}</code> = message</li>
				<li><code>{3}</code> = url</li>
				<li><code>{4}</code> = target</li>
			</ul>

			<div class="pre-container" data-type="HyperText Markup Language">
				&lt;div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">
					&lt;button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;&lt;/button>
					&lt;span data-notify="icon">&lt;/span>
					&lt;span data-notify="title">{1}&lt;/span>
					&lt;span data-notify="message">{2}&lt;/span>
					&lt;div class="progress" data-notify="progressbar">
						&lt;div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">&lt;/div>
					&lt;/div>
					&lt;a href="{3}" target="{4}" data-notify="url">&lt;/a>
				&lt;/div>
			</div>

			<h1 id="methods">Methods</h1>
			<p>To use a method you have to assign the notification to a variable when it is created. The example below will show you how to create a notification then update the <code>type</code> and <code>message</code> then close it.</p>

			<h2 id="methods-update">Update</h2>
			<div class="pre-container" data-type="JavaScript">
				var notify = $.notify('...');
				notify.update('title', '...');
				notify.update('message', '...');
				notify.update('icon', '...');
				notify.update('type', '...');
				notify.update('progress', '...');
				notify.update('url', '...');
				notify.update('target', '...');
			</div>

			<h2 id="methods-close">Close</h2>
			<div class="pre-container" data-type="JavaScript">
				var notify = $.notify('...');
				notify.close();
			</div>

			<h3>Example of how to use the methods</h3>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				var notify = $.notify('&lt;strong>Saving&lt;/strong> Do not close this page...', {
					allow_dismiss: false,
					showProgressbar: true
				});

				setTimeout(function() {
					notify.update({'type': 'success', 'message': '&lt;strong>Success&lt;/strong> Your page has been saved!', 'progress': 25});
				}, 4500);
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				var notify = $.notify('&lt;strong>Saving&lt;/strong> Do not close this page...', {
					type: 'success',
					allow_dismiss: false,
					showProgressbar: true
				});

				setTimeout(function() {
					notify.update('message', '&lt;strong>Saving&lt;/strong> Page Data.');
				}, 1000);

				setTimeout(function() {
					notify.update('message', '&lt;strong>Saving&lt;/strong> User Data.');
				}, 2000);

				setTimeout(function() {
					notify.update('message', '&lt;strong>Saving&lt;/strong> Profile Data.');
				}, 3000);

				setTimeout(function() {
					notify.update('message', '&lt;strong>Checking&lt;/strong> for errors.');
				}, 4000);
			</div>

			<h2 id="methods-setting-defaults">Setting Defaults Globally</h2>
			<div class="pre-container" data-type="JavaScript" data-run="true">
				$.notifyDefaults({
					type: 'success',
					allow_dismiss: false
				});
				$.notify('You can not close me!');
			</div>

			<h2 id="methods-close-all">Close All Notifications</h2>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notifyDefaults({
					allow_dismiss: false,
					delay: 0
				});
				var arrayAlign = ["left", "center", "right"];
				for (var iLoop = 0; iLoop < arrayAlign.length; iLoop++) {
					$.notify('Top ' + arrayAlign[iLoop], {
						placement: {
							align: arrayAlign[iLoop]
						}
					});
				}
				$.notifyDefaults({
					placement: {
						from: "bottom"
					},
					animate:{
						enter: "animated fadeInUp",
						exit: "animated fadeOutDown"
					}
				});
				for (var iLoop = 0; iLoop < arrayAlign.length; iLoop++) {
					$.notify('Bottom ' + arrayAlign[iLoop], {
						placement: {
							align: arrayAlign[iLoop]
						}
					});
				}
				setTimeout(function() {
					$.notifyClose();
				}, 3000);
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				for (var iLoop = 0; iLoop < 5; iLoop++) {
					$.notify('I will close before the delay!', {
						allow_dismiss: false
					});
				}
				$.notify('I will not close until my delay is up.', {
					allow_dismiss: false,
					placement: {
						from: 'bottom',
						align: 'left'
					}
				});
				setTimeout(function() {
					$.notifyClose('top-right');
				}, 3000);
			</div>

			<h1 id="examples">Examples</h1>

			<h2>Basic Bootstrap Notify</h2>
			<div class="pre-container" data-type="JavaScript" data-run="true">		
				$.notify("Hello World");
			</div>

			<h2>Passing in a title</h2>
			<div class="pre-container" data-type="JavaScript" data-run="true">		
				$.notify({
					title: "Welcome:",
					message: "This plugin has been provided to you by Robert McIntosh aka mouse0270"
				});
			</div>

			<h2>Passing <code>HTML</code></h2>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">	
				$.notify({
					title: "&lt;strong>Welcome:&lt;/strong> ",
					message: "This plugin has been provided to you by Robert McIntosh aka mouse0270"
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">					
				$.notify({
					title: "&lt;strong>Welcome:&lt;/strong> ",
					message: "This plugin has been provided to you by Robert McIntosh aka &lt;a href=\"https://twitter.com/Mouse0270\" target=\"_blank\">@mouse0270&lt;/a>"
				});
			</div>

			<h2>Using a Font Icon</h2>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">		
				$.notify({
					icon: 'glyphicon glyphicon-star',
					message: "Everyone loves font icons! Use them in your notification!"
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">		
				$.notify({
					icon: 'fa fa-paw',
					message: "You're not limited to just Bootstrap Font Icons"
				});
			</div>

			<h2>Using Images Instead of Font Icons</h2>
			<div class="pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					icon: "img/growl_64x.png",
					message: " I am using an image."
				},{
					icon_type: 'image'
				});
			</div>

			<h2>Using a URL</h2>
			<p>By default the plugin will set the target to <code>_blankM</code> causing the browser to open another <code>window</code>/<code>tab</code> when clicking on the notification.
			<div class="pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					message: "Check out my twitter account by clicking on this notification!",
					url: "https://twitter.com/Mouse0270"
				});
			</div>

			<h2>Using a URL with a Specific Target</h2>
			<p>You are able to set the target using two ways. You can either pass it within the <code>options</code> or the <code>settings</code>. The first example below is passing it as an <code>option</code> and the second example is passing it as a <code>setting</code>.</p>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					message: "Check out my twitter account by clicking on this notification!",
					url: "https://twitter.com/Mouse0270",
					target: "_self"
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					message: "Check out my twitter account by clicking on this notification!",
					url: "https://twitter.com/Mouse0270"
				},{
					url_target: "_self"
				});
			</div>
			<p>Please keep in mind that if you pass a target in the <code>options</code> it will override the <code>settings</code>. Below is demonstarting this. The first example will open in the same window because we have update the notify defaults by setting <code>url_target</code> to <code>_self</code>. The Second example will up in a new <code>window</code>/<code>tab</code> even though we have we set the default to <code>_self</code> because we passed the <code>target</code> as <code>_blank</code>.</p>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notifyDefaults({
					url_target: "_self"
				});
				$.notify({
					message: "Check out my twitter account by clicking on this notification!",
					url: "https://twitter.com/Mouse0270"
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notifyDefaults({
					url_target: "_self"
				});
				$.notify({
					message: "Check out my twitter account by clicking on this notification!",
					url: "https://twitter.com/Mouse0270",
					target: "_blank"
				});
			</div>

			<h2>Using Offset</h2>
			<p>You can pass an offset to make the notifications start farther or closer to the edge of the browser. You can either pass an <code>integer</code> or an <code>object</code>.</p>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify('Hello World', {
					offset: 50
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify('Hello World', {
					offset: {
						x: 50,
						y: 100
					}
				});
			</div>

			<h2>Using Bootstrap Alert Types</h2>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					title: '&lt;strong>Heads up!&lt;/strong>',
					message: 'Bootstrap Notify uses Bootstrap Info Alert styling as its default setting.'
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					title: '&lt;strong>Heads up!&lt;/strong>',
					message: 'You can use any of bootstraps other alert styles as well by default.'
				},{
					type: 'success'
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					title: '&lt;strong>Heads up!&lt;/strong>',
					message: 'You can use any of bootstraps other alert styles as well by default.'
				},{
					type: 'warning'
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					title: '&lt;strong>Heads up!&lt;/strong>',
					message: 'You can use any of bootstraps other alert styles as well by default.'
				},{
					type: 'danger'
				});
			</div>

			<h3>Animating Bootstrap Notify</h3>
			<p>One of the most powerful features in Bootstrap Notify is that you can easily animate how it enters and exits the screen using CSS (Please note that you can no longer animate the notifications using jquery).</p>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Fade In and Down<br/>Exit: Fade Out and Up");
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Fade In and Right<br/>Exit: Fade Out and Right", {
					animate: {
						enter: 'animated fadeInRight',
						exit: 'animated fadeOutRight'
					}								
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Bounce In from Top<br/>Exit: Bounce Up and Out", {
					animate: {
						enter: 'animated bounceInDown',
						exit: 'animated bounceOutUp'
					}								
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Bounce In<br/>Exit: Bounce Out", {
					animate: {
						enter: 'animated bounceIn',
						exit: 'animated bounceOut'
					}								
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Flip In on Y Axis<br/>Exit: Flip Out on X Axis", {
					animate: {
						enter: 'animated flipInY',
						exit: 'animated flipOutX'
					}								
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Light Speed In<br/>Exit: Light Speed Out", {
					animate: {
						enter: 'animated lightSpeedIn',
						exit: 'animated lightSpeedOut'
					}								
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Roll In<br/>Exit: Roll Out", {
					animate: {
						enter: 'animated rollIn',
						exit: 'animated rollOut'
					}								
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Enter: Zoom Down and In<br/>Exit: Zoom Up and Out", {
					animate: {
						enter: 'animated zoomInDown',
						exit: 'animated zoomOutUp'
					}								
				});
			</div>

			<h3>Newest Notifications On Top</h3>
			<p>As of Bootstrap Notify 3+ there is a new option that will allow you to have newer notifications push down older ones. If you click on the example below you will notice that each new notification is added after the last notification in the list. However in the second example you will see that it pushes the older notifications down leaving the newest on above the others.</p>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Hello World: I was added to the bottom.");
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify("Hello World: I was added to the top.", {
					newest_on_top: true
				});
			</div>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<p><strong>Warning!</strong> be careful when setting <code>newest_on_top</code> to <code>true</code> when a <code>placement</code> that already contains a notification has <code>newest_on_top</code> to <code>false</code>. It may cause issues with the plugins ability to place the notification in the correct location.</p>
			</div>

			<h2>Customized Notifications</h2>
			<p>Below is a list custom styled notifications that you may use as a whole or a starting off point. I'll will occasionally update this list so please check back for more styles.</p>

			<h3>
				<a href="https://dribbble.com/shots/789725-Minimalist-notify-Notification-2x?list=tags&tag=notify&offset=46" target="_blank">Minimalist notify Notification</a> by <a href="https://dribbble.com/dannykeane" target="_blank">Danny Keane</a>
			</h3>

			<div class="pre-joined pre-container" data-type="Cascade Style Sheet">
				.alert-minimalist {
					background-color: rgb(241, 242, 240);
					border-color: rgba(149, 149, 149, 0.3);
					border-radius: 3px;
					color: rgb(149, 149, 149);
					padding: 10px;
				}
				.alert-minimalist > [data-notify="icon"] {
					height: 50px;
					margin-right: 12px;
				}
				.alert-minimalist > [data-notify="title"] {
					color: rgb(51, 51, 51);
					display: block;
					font-weight: bold;
					margin-bottom: 5px;
				}
				.alert-minimalist > [data-notify="message"] {
					font-size: 80%;
				}
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
					title: 'Byron Morgan',
					message: 'Momentum reduce child mortality effectiveness incubation empowerment connect.'
				},{
					type: 'minimalist',
					delay: 5000,
					icon_type: 'image',
					template: '&lt;div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
						'&lt;img data-notify="icon" class="img-circle pull-left">' +
						'&lt;span data-notify="title">{1}&lt;/span>' +
						'&lt;span data-notify="message">{2}&lt;/span>' +
					'&lt;/div>'
				});
			</div>

			<h3>
				<a href="https://dribbble.com/shots/268958-Simple-Pastel-notify-Theme?list=tags&tag=notify&offset=117" target="_blank">Simple Pastel notify Theme</a> by <a href="https://dribbble.com/Marxamus" target="_blank">Mark Gilliland</a>
			</h3>

			<div class="pre-joined pre-container" data-type="Cascade Style Sheet">
				@import url(http://fonts.googleapis.com/css?family=Old+Standard+TT:400,700);
				[data-notify="container"][class*="alert-pastel-"] {
					background-color: rgb(255, 255, 238);
					border-width: 0px;
					border-left: 15px solid rgb(255, 240, 106);
					border-radius: 0px;
					box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.3);
					font-family: 'Old Standard TT', serif;
					letter-spacing: 1px;
				}
				[data-notify="container"].alert-pastel-info {
					border-left-color: rgb(255, 179, 40);
				}
				[data-notify="container"].alert-pastel-danger {
					border-left-color: rgb(255, 103, 76);
				}
				[data-notify="container"][class*="alert-pastel-"] > [data-notify="title"] {
					color: rgb(80, 80, 57);
					display: block;
					font-weight: 700;
					margin-bottom: 5px;
				}
				[data-notify="container"][class*="alert-pastel-"] > [data-notify="message"] {
					font-weight: 400;
				}
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					title: 'Email: Erica Fisher',
					message: 'Investment, stakeholders micro-finance equity health Bloomberg; global citizens climate change. Solve positive social change sanitation, opportunity insurmountable challenges...'
				},{
					type: 'pastel-warning',
					delay: 5000,
					template: '&lt;div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
						'&lt;span data-notify="title">{1}&lt;/span>' +
						'&lt;span data-notify="message">{2}&lt;/span>' +
					'&lt;/div>'
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					title: 'Application Installing',
					message: 'Developing nations social innovation shift globalization, invest safeguards life-expectancy positive social change. Gender care, new approaches empowerment diversity.'
				},{
					type: 'pastel-info',
					delay: 5000,
					template: '&lt;div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
						'&lt;span data-notify="title">{1}&lt;/span>' +
						'&lt;span data-notify="message">{2}&lt;/span>' +
					'&lt;/div>'
				});
			</div>
			<div class="pre-joined pre-container" data-type="JavaScript" data-run="true">
				$.notify({
					title: 'EVERYTHING IS CRASHING!',
					message: 'Working families Global South working alongside NGO research breakthrough insights public-private partnerships. Tackle contribution, equal opportunity, design thinking.'
				},{
					type: 'pastel-danger',
					delay: 5000,
					template: '&lt;div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
						'&lt;span data-notify="title">{1}&lt;/span>' +
						'&lt;span data-notify="message">{2}&lt;/span>' +
					'&lt;/div>'
				});
			</div>
		</div>
	</section>

	<!-- Back to top -->
	<a href="#0" class="back-to-top cd-top"><span class="[ fa fa-chevron-up ]"></span> <span class="[ ]">Back to the Top</span></a>

	<!-- Core JavaScript/jQuery Plugins -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>

	<script src="js/jquery.sharrre.js"></script>

	<!-- Custom JavaScript/jQuery Plugins -->
	<script src="js/bootstrap-notify.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
	<!--begin::Menu Container-->
	<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
		<!--begin::Menu Nav-->
		<ul class="menu-nav">

			<li>
				<div class="text-center mb-10">
					<div class="symbol symbol-60 symbol-circle">
						<div class="symbol-label" style="background-image:url('{{ url('assets/media/users/fotoPerfil.jpg') }}')">
						</div>
						<i class="symbol-badge symbol-badge-bottom bg-success"></i>
					</div>
					@guest
						<h4 class="font-weight-bold my-2 text-success">INVITADO</h4>
						{{-- <a href="{{ url('User/registro')}}"class="text-light mb-2">REGISTRATE</a> --}}
					@endguest

					@auth
						<h4 class="font-weight-bold my-2 text-success">{{ Auth::user()->name }}</h4>
						<div class="text-light mb-2">{{ Auth::user()->perfil }}</div>
				
						<br />
						<a href="{{ route('logout') }}"
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
							class="label label-light-danger label-inline font-weight-bold label-lg">Salir</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					@endauth
				</div>
			</li>

			@guest

				<li class="menu-item" aria-haspopup="true">
					<a href="{{ url('User/registro') }}" class="menu-link">
						<i class="far fa-edit menu-icon"></i>
						<span class="menu-text">REGISTRATE</span>
					</a>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="{{ url('/login') }}" class="menu-link">
						<i class="fas fa-user-circle menu-icon"></i>
						<span class="menu-text">INGRESA</span>
					</a>
				</li>
				
			@endguest

			<li class="menu-item" aria-haspopup="true">
				<a href="{{ url('localizacion/mapa') }}" class="menu-link">
					<i class="fas fa-solar-panel menu-icon"></i>
					<span class="menu-text">Mapa</span>
				</a>
			</li>

			<li class="menu-item" aria-haspopup="true">
				<a href="{{ url('/') }}" class="menu-link">
					<i class="far fa-user-circle menu-icon"></i>
					<span class="menu-text">Social</span>
				</a>
			</li>

			@auth
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Book-open.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
							viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path
									d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
									fill="#000000" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
					<span class="menu-text">Usuarios</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">Usuarios</span>
							</span>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('User/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Listado</span>
							</a>
						</li>
						
					</ul>
				</div>
			</li>

			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Book-open.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
							viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path
									d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
									fill="#000000" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
					<span class="menu-text">Clientes</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">Clientes</span>
							</span>
						</li>

						{{-- <li class="menu-item" aria-haspopup="true">
							<a href="{{ url('User/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Nuevo</span>
							</a>
						</li> --}}

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Cliente/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Listado</span>
							</a>
						</li>
						
					</ul>
				</div>
			</li>

			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Book-open.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
							viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path
									d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z"
									fill="#000000" />
								<path
									d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z"
									fill="#000000" opacity="0.3" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
					<span class="menu-text">Distritos</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">Distritos</span>
							</span>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Sector/distritos') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Listado</span>
							</a>
						</li>
			
					</ul>
				</div>
			</li>
		</ul>

		@endauth
		<!--end::Menu Nav-->
	</div>
	<!--end::Menu Container-->
</div>
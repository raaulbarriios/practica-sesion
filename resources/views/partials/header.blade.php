<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
    <nav class="flex items-center justify-between gap-4">
        <!-- Logo / Home Link -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-semibold text-[#1b1b18] dark:text-[#EDEDEC] hover:opacity-80 transition-opacity">
            <svg class="h-6 w-auto text-[#f53003]" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M61.8548 14.6253C61.8778 15.0456 61.8524 15.4668 61.779 15.8837L59.3907 29.4328C59.0883 31.1479 57.8767 32.5539 56.2412 33.088L41.3411 37.9547C39.6997 38.4907 37.9048 37.8967 36.8772 36.4781L28.1887 24.475C27.2023 23.1121 27.241 21.2688 28.2838 19.949L37.1593 8.71261C38.2045 7.38977 39.9998 6.81559 41.6358 7.37133L56.5517 12.4377C57.4947 12.758 58.3308 13.3444 58.9491 14.1189C61.0267 13.7844 61.7431 12.5937 61.8548 14.6253Z" fill="currentColor"/>
                <path d="M41.7451 44.8711C41.7681 45.2915 41.7427 45.7127 41.6693 46.1296L39.281 59.6787C38.9786 61.3938 37.767 62.7998 36.1315 63.3339L21.2314 68.2006C19.59 68.7366 17.7951 68.1426 16.7675 66.724L8.079 54.7209C7.0926 53.358 7.1313 51.5147 8.1741 50.1949L17.0496 38.9585C18.0948 37.6357 19.8901 37.0615 21.5261 37.6172L36.442 42.6836C37.385 43.0039 38.2211 43.5903 38.8394 44.3648C40.917 44.0303 41.6334 42.8396 41.7451 44.8711Z" fill="currentColor" fill-opacity="0.8"/>
            </svg>
            <span class="tracking-tight text-base font-bold">Práctica Sesión</span>
        </a>

        <!-- Auth Navigation based on session('token') -->
        <div class="flex items-center gap-3">
            @if (session('token'))
                <div class="flex items-center gap-3 sm:gap-4">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 font-medium text-xs sm:text-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Hola, <span class="font-bold">{{ session('name') }}</span>
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button
                            type="submit"
                            id="logout-button"
                            class="inline-flex items-center gap-1.5 px-4 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-[#19140035] hover:border-[#f53003] hover:text-[#f53003] dark:border-[#3E3E3A] dark:hover:border-[#f53003] dark:hover:text-[#f53003] rounded-md text-sm leading-normal transition-colors cursor-pointer bg-white dark:bg-[#161615] shadow-xs font-medium"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            @else
                <div class="flex items-center gap-2 sm:gap-3">
                    <a
                        href="{{ route('login') }}"
                        id="login-button"
                        class="inline-block px-4 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-md text-sm leading-normal transition-colors font-medium"
                    >
                        Iniciar sesión
                    </a>

                    <a
                        href="{{ route('register') }}"
                        id="register-button"
                        class="inline-block px-4 py-1.5 text-white bg-[#f53003] hover:bg-[#e02b02] border border-[#f53003] rounded-md text-sm leading-normal transition-colors shadow-xs font-medium"
                    >
                        Crear cuenta
                    </a>
                </div>
            @endif
        </div>
    </nav>
</header>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Wrapped - Cumpleaños</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        body { background-color: #191414; color: white; font-family: 'Circular', sans-serif; }
        .slide-enter { animation: fade-in 0.5s ease-out; }
        @keyframes fade-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        
        /* Text Animations */
        .animate-title { animation: slide-up 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; transform: translateY(20px); }
        .animate-subtitle { animation: slide-up 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) 0.3s forwards; opacity: 0; transform: translateY(20px); }
        
        @keyframes slide-up {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden flex items-center justify-center"
      x-data="wrapped()"
      x-init="initWrapped()">

    <!-- Audio Element -->
    <audio x-ref="audio" src="{{ asset('audio/musica.mp3') }}" loop></audio>

    <!-- Welcome Screen (Abstract Hero Style) -->
    <div x-show="!started" class="relative h-full w-full bg-black flex flex-col p-8 overflow-hidden">
        
        <!-- Top Left Decoration (Neon Lines) -->
        <div class="absolute -top-10 -left-10 w-96 h-96 pointer-events-none opacity-80">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <path d="M-20,50 Q80,20 150,80" fill="none" stroke="#E91429" stroke-width="6" stroke-linecap="round" />
                <path d="M-20,70 Q80,40 160,100" fill="none" stroke="#F573A0" stroke-width="6" stroke-linecap="round" />
                <path d="M-20,90 Q80,60 140,120" fill="none" stroke="#831843" stroke-width="6" stroke-linecap="round" />
            </svg>
        </div>

        <!-- Top Right Image (Floating Box) -->
        <div class="absolute top-8 right-6 w-32 h-48 bg-gradient-to-br from-pink-500 to-purple-600 rounded-lg transform rotate-6 shadow-2xl overflow-hidden border border-white/20 z-10">
             <img src="{{ asset('images/wrapped/foto_portada.jpeg') }}" class="w-full h-full object-cover opacity-90" alt="Cover">
        </div>

        <!-- Main Content (Centered) -->
        <div class="flex-1 flex flex-col justify-center items-start z-20 mt-16">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-6 opacity-90">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                <span class="font-bold tracking-widest text-xs uppercase">Ajelandra wrapped</span>
            </div>

            <!-- Big Text -->
            <h1 class="text-5xl md:text-6xl font-black leading-tight mb-8 tracking-tight">
                Feliz<br>
                <span class="text-[#F573A0]">pumpeaños</span> mi<br>
                corazón de<br>
                <span class="text-[#E91429]">melón.</span>
            </h1>

            <!-- Subtext -->
            <p class="text-gray-400 text-lg mb-12 font-medium">
                este y todos los que faltan...<br>
            </p>

            <!-- Button -->
            <button @click="startPresentation()"
                    class="bg-white text-black font-bold py-4 px-10 rounded-full text-lg hover:scale-105 transition transform shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                Iniciar
            </button>
        </div>

        <!-- Bottom Right Decoration (Pixel Star) -->
        <div class="absolute bottom-12 right-8 pointer-events-none">
            <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="animate-pulse">
                <path d="M45 0H55V45H100V55H55V100H45V55H0V45H45V0Z" fill="white"/>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div x-show="started" class="relative w-full h-full max-w-md mx-auto bg-black md:rounded-xl md:h-[90vh] md:border md:border-gray-800 overflow-hidden shadow-2xl" style="display: none;">

        <!-- Progress Bars -->
        <div class="absolute top-0 left-0 w-full p-2 flex gap-1 z-20">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="h-1 flex-1 bg-gray-600 rounded-full overflow-hidden">
                    <div class="h-full bg-white transition-all duration-100 ease-linear"
                         :style="'width: ' + (currentIndex > index ? '100%' : (currentIndex === index ? progress + '%' : '0%'))">
                    </div>
                </div>
            </template>
        </div>

        <!-- Mute Button -->
        <button @click="toggleMute()" class="absolute top-6 right-4 z-30 bg-black/50 p-2 rounded-full backdrop-blur-sm">
            <span x-show="!muted">🔊</span>
            <span x-show="muted">🔇</span>
        </button>

        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentIndex === index"
                 class="absolute inset-0 flex flex-col p-6 pt-12 slide-enter"
                 :style="'background: linear-gradient(to bottom, ' + slide.color_hex + '40, #000000)'">

                <!-- Image -->
                <div class="flex-1 flex items-center justify-center mb-8">
                    <div class="w-full aspect-square rounded-xl overflow-hidden shadow-2xl relative">
                         <img :src="slide.imagen" class="w-full h-full object-cover" alt="Foto">
                    </div>
                </div>

                <!-- Text -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-2 animate-title" x-text="slide.titulo" :style="'color: ' + slide.color_hex"></h2>
                    <p class="text-xl text-gray-200 font-medium animate-subtitle" x-text="slide.subtitulo"></p>
                </div>
            </div>
        </template>

        <!-- Navigation Areas (Tap left/right) -->
        <div class="absolute inset-0 flex z-10">
            <div class="w-1/3 h-full" @click="prevSlide()"></div>
            <div class="w-1/3 h-full" @click="togglePause()"></div>
            <div class="w-1/3 h-full" @click="nextSlide()"></div>
        </div>

    </div>

    <script>
        function wrapped() {
            return {
                started: false,
                currentIndex: 0,
                slides: @json($slides),
                progress: 0,
                timer: null,
                interval: 50, // Update every 50ms
                duration: 12000, // 12 seconds per slide
                muted: false,
                paused: false,

                initWrapped() {
                    // Preload images
                    this.slides.forEach(slide => {
                        const img = new Image();
                        img.src = slide.imagen;
                    });
                },

                startPresentation() {
                    this.started = true;
                    this.$refs.audio.play().catch(e => console.log("Audio play failed", e));
                    this.startTimer();
                },

                startTimer() {
                    clearInterval(this.timer);
                    this.timer = setInterval(() => {
                        if (!this.paused) {
                            this.progress += (this.interval / this.duration) * 100;
                            if (this.progress >= 100) {
                                this.nextSlide();
                            }
                        }
                    }, this.interval);
                },

                nextSlide() {
                    if (this.currentIndex < this.slides.length - 1) {
                        this.currentIndex++;
                        this.progress = 0;
                        if (this.currentIndex === this.slides.length - 1) {
                            this.fireConfetti();
                        }
                    } else {
                        // End of presentation
                        this.progress = 100;
                        clearInterval(this.timer);
                        // Keep firing confetti at the end
                        this.fireConfetti();
                    }
                },

                prevSlide() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                        this.progress = 0;
                    }
                },

                toggleMute() {
                    this.muted = !this.muted;
                    this.$refs.audio.muted = this.muted;
                },

                togglePause() {
                    this.paused = !this.paused;
                },

                fireConfetti() {
                    var duration = 3 * 1000;
                    var animationEnd = Date.now() + duration;
                    var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0, colors: ['#ff0000', '#ffffff'] };

                    var random = function(min, max) {
                        return Math.random() * (max - min) + min;
                    };

                    var interval = setInterval(function() {
                        var timeLeft = animationEnd - Date.now();

                        if (timeLeft <= 0) {
                            return clearInterval(interval);
                        }

                        var particleCount = 50 * (timeLeft / duration);
                        confetti(Object.assign({}, defaults, { particleCount, origin: { x: random(0.1, 0.3), y: Math.random() - 0.2 } }));
                        confetti(Object.assign({}, defaults, { particleCount, origin: { x: random(0.7, 0.9), y: Math.random() - 0.2 } }));
                    }, 250);
                }
            }
        }
    </script>
</body>
</html>

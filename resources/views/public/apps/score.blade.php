<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Scoreboard Pro')</title>

    <!-- Google Fonts: Inter & Orbitron -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;800;900&family=Orbitron:wght@800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #030712; }
        .font-digital { font-family: 'Orbitron', monospace; }
    </style>
</head>

<body class="bg-gray-950 text-white min-h-screen flex flex-col justify-between selection:bg-purple-600">

    <div x-data="volleyballScoreboard()" x-ref="fullscreenContainer" class="flex-1 flex flex-col justify-between p-2 sm:p-4 bg-gray-950 relative select-none">
        
        <!-- Header Mode Fullscreen -->
        <header class="flex justify-between items-center z-10 border-b border-gray-800/80 pb-1.5 sm:pb-3">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-purple-500 animate-pulse"></span>
                <span class="text-[10px] sm:text-xs font-black tracking-widest text-purple-400 uppercase">VOLLEYBALL SCOREBOARD</span>
            </div>

            <button @click="toggleFullscreen()" 
                class="bg-gray-900 hover:bg-gray-800 text-gray-300 px-2.5 py-1 sm:px-3.5 sm:py-1.5 rounded-xl border border-gray-800 text-[10px] sm:text-xs font-bold transition flex items-center gap-1.5 sm:gap-2">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                <span x-text="isFullscreen ? 'Keluar Fullscreen' : 'Layar Penuh (HP)'"></span>
            </button>
        </header>

        <!-- Main Display Container -->
        <main class="grid grid-cols-2 gap-2 sm:gap-6 my-auto py-1 sm:py-2 max-w-6xl mx-auto w-full items-center">
            
            <!-- CARD TIM A -->
            <div class="bg-gray-900/90 border-2 rounded-2xl sm:rounded-3xl p-2 sm:p-6 flex flex-col justify-between items-center transition-all duration-300 relative shadow-2xl"
                 :class="servingTeam === 'A' ? 'border-purple-500 ring-2 sm:ring-4 ring-purple-500/20' : 'border-gray-800/80'">
                
                <!-- Servis Indicator & Input Nama -->
                <div class="w-full flex flex-col items-center gap-1 sm:gap-2">
                    <button @click="setServe('A')" 
                        class="text-[9px] sm:text-xs font-black uppercase tracking-wider px-2.5 py-0.5 sm:px-3.5 sm:py-1.5 rounded-full border transition-all flex items-center gap-1 sm:gap-1.5"
                        :class="servingTeam === 'A' ? 'bg-purple-600 border-purple-400 text-white shadow-md' : 'bg-gray-950 border-gray-800 text-gray-500 hover:text-gray-300'">
                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full" :class="servingTeam === 'A' ? 'bg-white animate-ping' : 'bg-gray-600'"></span>
                        <span x-text="servingTeam === 'A' ? 'SERVIS / BOLA' : 'ATUR SERVIS'"></span>
                    </button>

                    <input type="text" x-model="teamNameA" 
                        class="bg-transparent text-center text-base sm:text-3xl font-black text-white border-b border-transparent focus:border-purple-500 focus:outline-none w-full py-0.5 sm:py-1 uppercase tracking-wide">
                </div>

                <!-- Display Skor Super Besar -->
                <div class="my-0.5 sm:my-4 text-center w-full">
                    <div class="font-digital text-5xl sm:text-8xl leading-none font-black text-purple-400 drop-shadow-[0_0_25px_rgba(168,85,247,0.4)] tracking-tighter"
                         x-text="scoreA">0</div>
                </div>

                <!-- Tombol Kontrol Elegan di Bawah Skor -->
                <div class="flex items-center justify-center gap-2 sm:gap-3 w-full pt-0.5 sm:pt-1">
                    <button @click="updateScore('A', -1)" 
                        class="w-8 h-8 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-gray-950 hover:bg-rose-950/50 text-rose-500 border border-gray-800 hover:border-rose-500/50 font-black text-base sm:text-2xl transition active:scale-90 flex items-center justify-center shadow-lg">
                        -
                    </button>
                    <button @click="updateScore('A', 1)" 
                        class="flex-1 max-w-[140px] h-8 sm:h-16 rounded-xl sm:rounded-2xl bg-purple-600 hover:bg-purple-500 text-white font-black text-base sm:text-2xl transition active:scale-95 flex items-center justify-center border border-purple-400 shadow-lg shadow-purple-600/30">
                        +1
                    </button>
                </div>
            </div>

            <!-- CARD TIM B -->
            <div class="bg-gray-900/90 border-2 rounded-2xl sm:rounded-3xl p-2 sm:p-6 flex flex-col justify-between items-center transition-all duration-300 relative shadow-2xl"
                 :class="servingTeam === 'B' ? 'border-purple-500 ring-2 sm:ring-4 ring-purple-500/20' : 'border-gray-800/80'">
                
                <!-- Servis Indicator & Input Nama -->
                <div class="w-full flex flex-col items-center gap-1 sm:gap-2">
                    <button @click="setServe('B')" 
                        class="text-[9px] sm:text-xs font-black uppercase tracking-wider px-2.5 py-0.5 sm:px-3.5 sm:py-1.5 rounded-full border transition-all flex items-center gap-1 sm:gap-1.5"
                        :class="servingTeam === 'B' ? 'bg-purple-600 border-purple-400 text-white shadow-md' : 'bg-gray-950 border-gray-800 text-gray-500 hover:text-gray-300'">
                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full" :class="servingTeam === 'B' ? 'bg-white animate-ping' : 'bg-gray-600'"></span>
                        <span x-text="servingTeam === 'B' ? 'SERVIS / BOLA' : 'ATUR SERVIS'"></span>
                    </button>

                    <input type="text" x-model="teamNameB" 
                        class="bg-transparent text-center text-base sm:text-3xl font-black text-white border-b border-transparent focus:border-purple-500 focus:outline-none w-full py-0.5 sm:py-1 uppercase tracking-wide">
                </div>

                <!-- Display Skor Super Besar -->
                <div class="my-0.5 sm:my-4 text-center w-full">
                    <div class="font-digital text-5xl sm:text-8xl leading-none font-black text-red-400 drop-shadow-[0_0_25px_rgba(168,85,247,0.4)] tracking-tighter"
                         x-text="scoreB">0</div>
                </div>

                <!-- Tombol Kontrol Elegan di Bawah Skor -->
                <div class="flex items-center justify-center gap-2 sm:gap-3 w-full pt-0.5 sm:pt-1">
                    <button @click="updateScore('B', -1)" 
                        class="w-8 h-8 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-gray-950 hover:bg-rose-950/50 text-rose-500 border border-gray-800 hover:border-rose-500/50 font-black text-base sm:text-2xl transition active:scale-90 flex items-center justify-center shadow-lg">
                        -
                    </button>
                    <button @click="updateScore('B', 1)" 
                        class="flex-1 max-w-[140px] h-8 sm:h-16 rounded-xl sm:rounded-2xl bg-purple-600 hover:bg-purple-500 text-white font-black text-base sm:text-2xl transition active:scale-95 flex items-center justify-center border border-purple-400 shadow-lg shadow-purple-600/30">
                        +1
                    </button>
                </div>
            </div>

        </main>

        <!-- Footer Bar: Audio & Reset Sejajar di Bawah -->
        <footer class="z-10 max-w-6xl mx-auto w-full border-t border-gray-800/80 pt-1.5 sm:pt-3 flex justify-between items-center gap-2 sm:gap-3">
            <button @click="speakCurrentScore()" 
                class="flex-1 bg-purple-600 hover:bg-purple-500 text-white font-black py-2 sm:py-3.5 px-3 sm:px-6 rounded-xl sm:rounded-2xl border border-purple-400 shadow-lg transition active:scale-95 flex items-center justify-center gap-2 text-xs sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/></svg>
                <span>BUNYIKAN SUARA SKOR</span>
            </button>

            <button @click="resetScore()" 
                class="bg-gray-900 hover:bg-gray-800 text-gray-300 font-bold py-2 sm:py-3.5 px-3 sm:px-6 rounded-xl sm:rounded-2xl border border-gray-800 transition active:scale-95 text-xs sm:text-base">
                RESET SKOR
            </button>
        </footer>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('volleyballScoreboard', () => ({
                scoreA: 0,
                scoreB: 0,
                teamNameA: 'TIM A',
                teamNameB: 'TIM B',
                servingTeam: 'A',
                isFullscreen: false,

                setServe(team) {
                    this.servingTeam = team;
                },

                updateScore(team, value) {
                    if (team === 'A') {
                        this.scoreA = Math.max(0, this.scoreA + value);
                        if (value > 0) this.servingTeam = 'A';
                    } else if (team === 'B') {
                        this.scoreB = Math.max(0, this.scoreB + value);
                        if (value > 0) this.servingTeam = 'B';
                    }

                    this.syncToBackend();
                },

                resetScore() {
                    this.scoreA = 0;
                    this.scoreB = 0;
                    this.servingTeam = 'A';
                    this.syncToBackend();
                },

                speakCurrentScore() {
                    if ('speechSynthesis' in window) {
                        window.speechSynthesis.cancel();

                        let scoreServing = 0;
                        let scoreReceiving = 0;

                        if (this.servingTeam === 'A') {
                            scoreServing = this.scoreA;
                            scoreReceiving = this.scoreB;
                        } else {
                            scoreServing = this.scoreB;
                            scoreReceiving = this.scoreA;
                        }

                        let text = `${scoreServing}, ${scoreReceiving}`;

                        let utterance = new SpeechSynthesisUtterance(text);
                        utterance.lang = 'id-ID';
                        utterance.rate = 0.9;

                        window.speechSynthesis.speak(utterance);
                    }
                },

                toggleFullscreen() {
                    let elem = this.$refs.fullscreenContainer;
                    if (!document.fullscreenElement) {
                        if (elem.requestFullscreen) {
                            elem.requestFullscreen();
                        } else if (elem.webkitRequestFullscreen) {
                            elem.webkitRequestFullscreen();
                        } else if (elem.msRequestFullscreen) {
                            elem.msRequestFullscreen();
                        }
                        this.isFullscreen = true;
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        }
                        this.isFullscreen = false;
                    }
                },

                syncToBackend() {
                    fetch('/volleyball/update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            score_a: this.scoreA,
                            score_b: this.scoreB,
                            team_a: this.teamNameA,
                            team_b: this.teamNameB,
                            serving_team: this.servingTeam
                        })
                    }).catch(error => console.error('Error syncing score:', error));
                }
            }));
        });
    </script>

</body>
</html>
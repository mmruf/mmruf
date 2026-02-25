@extends('layouts.guest')

@section('title', 'MMRUF | Love Checker')

@section('content')
    <div id="emoji-container" class="fixed inset-0 pointer-events-none z-[60]"></div>

    <div x-data="loveLogic()" class="max-w-md w-full">
        <div class="bg-white border border-slate-200 shadow-2xl rounded-[2.5rem] p-10 relative overflow-hidden transition-all duration-500">
            
            <div class="flex gap-2 mb-8 justify-center">
                <template x-for="i in 3">
                    <div :class="step >= i ? 'bg-rose-500 w-8' : 'bg-slate-100 w-3'"
                        class="h-1.5 rounded-full transition-all duration-500"></div>
                </template>
            </div>

            <div x-show="step === 1" x-transition:enter="fade-in-up">
                <h2 class="text-2xl font-black text-slate-900 text-center mb-6 tracking-tight">Siapa nama Anda?</h2>
                <input type="text" x-model="formData.name"
                    class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 outline-none transition text-center text-xl font-bold"
                    placeholder="Ketik di sini...">
                <button @click="nextStep()" :disabled="!formData.name"
                    class="w-full mt-6 bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-slate-800 transition shadow-lg disabled:opacity-50">
                    Lanjut
                </button>
            </div>

            <div x-show="step === 2" x-cloak x-transition:enter="fade-in-up">
                <h2 class="text-2xl font-black text-slate-900 text-center mb-8 tracking-tight">Jujur, Anda cinta atau tidak?</h2>
                <div class="grid grid-cols-2 gap-4">
                    <button @click="triggerEffect(['💕', '💗', '💖']); formData.love_status = 'Cinta'; nextStep()"
                        class="group p-6 border-2 border-slate-100 rounded-3xl hover:border-rose-500 hover:bg-rose-50 transition-all text-center">
                        <span class="text-4xl block mb-2 group-hover:scale-125 transition">❤️</span>
                        <span class="font-bold text-slate-700">Cinta</span>
                    </button>

                    <button @click="triggerEffect(['😭', '😢', '🥺']); formData.love_status = 'Tidak'; formData.seriousness = 'Main-main'; setTimeout(() => submitData(), 1500)"
                        class="group p-6 border-2 border-slate-100 rounded-3xl hover:border-slate-500 hover:bg-slate-50 transition-all text-center">
                        <span class="text-4xl block mb-2 group-hover:scale-125 transition">💔</span>
                        <span class="font-bold text-slate-700">Tidak</span>
                    </button>
                </div>
            </div>

            <div x-show="step === 3" x-cloak x-transition:enter="fade-in-up">
                <h2 class="text-2xl font-black text-slate-900 text-center mb-8 tracking-tight">Mau serius atau cuma main?</h2>
                <div class="space-y-4">
                    <button @click="triggerEffect(['💍', '💎', '✨']); formData.seriousness = 'Serius'; setTimeout(() => submitData(), 1500)"
                        class="w-full p-5 bg-white border-2 border-rose-500 text-rose-600 rounded-2xl font-black hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center gap-3">
                        💍 SERIUS BANGET
                    </button>
                    <button @click="triggerEffect(['😭', '😢', '🤡']); formData.seriousness = 'Main-main'; setTimeout(() => submitData(), 1500)"
                        class="w-full p-5 bg-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-200 transition-all text-sm">
                        Cuma main-main aja
                    </button>
                </div>
            </div>

            <div x-show="step === 4" x-cloak class="text-center py-6">
                <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 mb-2">Terima Kasih, <span x-text="formData.name"></span>!</h2>
                <p class="text-slate-500 leading-relaxed">Data perasaan Anda telah kami simpan di sistem MMRUF.</p>
                <button @click="step = 1; formData.name = ''"
                    class="mt-8 text-sm font-bold text-rose-500 hover:underline tracking-widest uppercase">Ulangi Tes</button>
            </div>
        </div>
    </div>

    <style>
        @keyframes fall {
            0% { transform: translateY(-10vh) rotate(0deg); opacity: 1; }
            100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
        }
        .rain-emoji {
            position: absolute;
            top: -50px;
            animation: fall linear forwards;
            user-select: none;
            z-index: 70;
        }
    </style>

    <script>
        function loveLogic() {
            return {
                step: 1,
                formData: {
                    name: '',
                    love_status: '',
                    seriousness: ''
                },
                nextStep() {
                    this.step++;
                },
                triggerEffect(emojiArray) {
                    // Membuat hujan emoji sebanyak 40 buah
                    for (let i = 0; i < 40; i++) {
                        const randomEmoji = emojiArray[Math.floor(Math.random() * emojiArray.length)];
                        this.createEmoji(randomEmoji);
                    }
                },
                createEmoji(icon) {
                    const container = document.getElementById('emoji-container');
                    const emoji = document.createElement('div');
                    emoji.innerText = icon;
                    emoji.classList.add('rain-emoji');
                    
                    emoji.style.left = Math.random() * 100 + 'vw';
                    emoji.style.animationDuration = (Math.random() * 2 + 1.5) + 's';
                    emoji.style.fontSize = (Math.random() * 2 + 1) + 'rem';
                    
                    container.appendChild(emoji);

                    setTimeout(() => { emoji.remove(); }, 3500);
                },
                async submitData() {
                    try {
                        const response = await fetch("{{ route('love.store') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify(this.formData)
                        });

                        if (response.ok) {
                            this.step = 4;
                        } else {
                            alert("Gagal menyimpan data.");
                        }
                    } catch (error) {
                        console.error("Error:", error);
                    }
                }
            }
        }
    </script>
@endsection
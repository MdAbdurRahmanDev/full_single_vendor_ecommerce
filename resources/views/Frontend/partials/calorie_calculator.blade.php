<div x-data="{ 
    open: false,
    gender: 'male',
    age: '',
    weight: '',
    height: '',
    activity: '1.2',
    result: null,
    calculate() {
        if(!this.age || !this.weight || !this.height) return;
        
        let bmr;
        if(this.gender === 'male') {
            bmr = 88.362 + (13.397 * this.weight) + (4.799 * this.height) - (5.677 * this.age);
        } else {
            bmr = 447.593 + (9.247 * this.weight) + (3.098 * this.height) - (4.330 * this.age);
        }
        
        this.result = Math.round(bmr * parseFloat(this.activity));
    }
}" @open-calorie-modal.window="open = true" class="relative z-[200]">
    
    <!-- Modal Backdrop -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"
         @click="open = false"></div>

    <!-- Modal Content -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
         class="fixed inset-0 flex items-center justify-center p-2 sm:p-6">
        
        <div @click.stop class="bg-white rounded-[40px] shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col md:flex-row h-auto max-h-[95vh] overflow-y-auto no-scrollbar">
            <!-- Left Side: Visual/Intro -->
            <div class="bg-brand p-8 md:p-12 md:w-2/5 flex flex-col justify-between text-white shrink-0">
                <div>
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h2 class="text-3xl font-black lowercase tracking-tighter leading-none mb-4">calorie calculator.</h2>
                    <p class="text-xs font-bold text-white/70 uppercase tracking-widest leading-relaxed">get your daily energy needs in seconds.</p>
                </div>
                <div class="mt-10 md:mt-0">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-40">be healthy. be happy.</p>
                </div>
            </div>

            <!-- Right Side: Form/Results -->
            <div class="p-6 sm:p-10 md:w-3/5 space-y-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Calculate below</span>
                    <button @click="open = false" class="text-gray-400 hover:text-brand transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Gender</label>
                        <select x-model="gender" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-1 focus:ring-brand focus:border-brand outline-none transition">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Age</label>
                        <input type="number" x-model="age" placeholder="25" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-1 focus:ring-brand focus:border-brand outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Weight (kg)</label>
                        <input type="number" x-model="weight" placeholder="70" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-1 focus:ring-brand focus:border-brand outline-none transition">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Height (cm)</label>
                        <input type="number" x-model="height" placeholder="175" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-1 focus:ring-brand focus:border-brand outline-none transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Activity Level</label>
                    <select x-model="activity" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-1 focus:ring-brand focus:border-brand outline-none transition">
                        <option value="1.2">Sedentary (little or no exercise)</option>
                        <option value="1.375">Lightly active (light exercise/sports 1-3 days/week)</option>
                        <option value="1.55">Moderately active (moderate exercise/sports 3-5 days/week)</option>
                        <option value="1.725">Very active (hard exercise/sports 6-7 days a week)</option>
                        <option value="1.9">Extra active (very hard exercise/sports & physical job)</option>
                    </select>
                </div>

                <button @click="calculate()" class="w-full bg-gray-900 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all shadow-xl active:scale-95 transform">
                    Calculate Now
                </button>

                <div x-show="result" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="pt-6 border-t border-gray-100 text-center">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Your Daily Requirement</p>
                    <div class="flex items-center justify-center space-x-2">
                        <span class="text-4xl font-black text-brand tracking-tighter" x-text="result"></span>
                        <span class="text-xl font-bold text-gray-900 tracking-tighter">kcal/day</span>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 mt-4 leading-relaxed italic">The results are based on the Harris-Benedict formula (TDEE).</p>
                </div>
            </div>
        </div>
    </div>
</div>

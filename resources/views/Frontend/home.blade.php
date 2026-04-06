@extends('Layouts.frontend')

@section('content')
    <!-- ═══ Health & Wellness Hub (Professional Version) ═══ -->
    <section class="py-16 bg-slate-50 border-y border-slate-100" x-data="healthHub()" id="wellness-center">
        <div class="container mx-auto px-4 max-w-6xl">

            <!-- Minimalist Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-slate-800 mb-3 tracking-tight">Health & Wellness Hub</h2>
                <div class="h-1 w-16 bg-brand mx-auto rounded-full mb-6"></div>

            </div>

            <!-- Sleek Tab Navigation -->
            <div class="flex justify-center mb-10">
                <div class="bg-slate-200/50 p-1 rounded-xl flex items-center border border-slate-200">
                    <button @click="activeTab='weight'"
                        :class="activeTab === 'weight' ? 'bg-white shadow text-slate-800' :
                            'text-slate-500 hover:bg-slate-200/50'"
                        class="px-8 py-2.5 rounded-lg text-sm font-bold transition-all duration-300">
                        Weight Range
                    </button>
                    <button @click="activeTab='calorie'"
                        :class="activeTab === 'calorie' ? 'bg-white shadow text-slate-800' :
                            'text-slate-500 hover:bg-slate-200/50'"
                        class="px-8 py-2.5 rounded-lg text-sm font-bold transition-all duration-300">
                        Calorie Calculator
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden min-h-[450px]">

                <!-- ── TAB 1: WEIGHT CHART ── -->
                <div x-show="activeTab==='weight'" class="p-8 md:p-12" x-transition:enter="transition-opacity duration-300">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                        <!-- Side Control -->
                        <div class="lg:col-span-12">
                            <div class="max-w-2xl mx-auto">
                                <!-- Gender Selection (Horizontal Buttons) -->
                                <div class="flex justify-center gap-4 mb-8">
                                    <button @click="chartGender='male'; lookupResult=null"
                                        :class="chartGender === 'male' ? 'bg-blue-600 text-white border-blue-600' :
                                            'bg-white text-slate-600 border-slate-200 hover:border-blue-300'"
                                        class="flex-1 border-2 py-4 rounded-xl font-bold text-sm tracking-wide transition-all shadow-sm flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Male
                                    </button>
                                    <button @click="chartGender='female'; lookupResult=null"
                                        :class="chartGender === 'female' ? 'bg-pink-600 text-white border-pink-600' :
                                            'bg-white text-slate-600 border-slate-200 hover:border-pink-300'"
                                        class="flex-1 border-2 py-4 rounded-xl font-bold text-sm tracking-wide transition-all shadow-sm flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Female
                                    </button>
                                </div>

                                <!-- Input Section (Inline) -->
                                <div class="flex flex-col md:flex-row items-center gap-3">
                                    <div class="relative flex-1 w-full">
                                        <input type="text" x-model="lookupHeight" @keyup.enter="findIdealWeight()"
                                            placeholder="Enter Height (e.g. 170 or 4.6)"
                                            class="w-full h-14 bg-slate-50 border border-slate-200 rounded-xl px-6 text-xl font-bold text-slate-800 focus:bg-white focus:border-brand focus:ring-4 focus:ring-brand/5 outline-none transition-all placeholder:text-slate-300">
                                    </div>
                                    <button @click="findIdealWeight()"
                                        class="w-full md:w-auto h-14 px-10 bg-slate-800 text-white rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-brand transition-all shadow-md flex items-center justify-center gap-2">
                                        Get Results
                                    </button>
                                </div>
                                <p class="text-center mt-4 text-xs text-slate-400 font-medium tracking-wide">
                                    Use <span class="text-slate-600 font-bold">CM</span> (170) or <span
                                        class="text-slate-600 font-bold">Feet.Inch</span> (4.6)
                                </p>
                            </div>
                        </div>

                        <!-- Result Section (Clean Cards) -->
                        <div x-show="lookupResult"
                            class="lg:col-span-12 grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 border-t border-slate-100 pt-10"
                            x-transition:enter="transition-opacity duration-500">
                            <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 relative group">
                                <span
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 block">Optimal
                                    weight range</span>
                                <div class="space-y-4">
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-5xl font-bold text-brand"
                                            x-text="lookupResult ? lookupResult.weightKg : ''"></span>
                                        <span class="text-sm font-bold text-slate-400 uppercase">KG</span>
                                    </div>
                                    <div class="w-full h-px bg-slate-200"></div>
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-2xl font-bold text-slate-700"
                                            x-text="lookupResult ? lookupResult.weightLb : ''"></span>
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-tighter">LB
                                            (POUNDS)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border border-slate-200 p-8 rounded-2xl shadow-sm">
                                <span
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 block">Calculated
                                    Metric</span>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <span class="text-3xl font-bold text-slate-800"
                                        x-text="lookupResult ? lookupResult.h : ''"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ── TAB 2: CALORIE CALCULATOR ── -->
                <div x-show="activeTab==='calorie'" style="display:none" class="p-8 md:p-12"
                    x-transition:enter="transition-opacity duration-300">
                    <div class="max-w-4xl mx-auto">
                        <!-- Calorie Gender Selection (Matching Weight Lab Style) -->
                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <button @click="gender='male'; resetCalorie()"
                                :class="gender === 'male' ? 'bg-blue-600 text-white border-blue-600' :
                                    'bg-white text-slate-600 border-slate-200 hover:border-blue-300'"
                                class="flex-1 border-2 py-4 rounded-xl font-bold text-sm tracking-wide transition-all shadow-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Male
                            </button>
                            <button @click="gender='female'; resetCalorie()"
                                :class="gender === 'female' ? 'bg-pink-600 text-white border-pink-600' :
                                    'bg-white text-slate-600 border-slate-200 hover:border-pink-300'"
                                class="flex-1 border-2 py-4 rounded-xl font-bold text-sm tracking-wide transition-all shadow-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Female
                            </button>
                        </div>

                        <!-- Input Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                            <!-- Age -->
                            <div
                                class="bg-slate-50 p-6 rounded-2xl border border-slate-100 focus-within:bg-white focus-within:border-brand transition-all">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">AGE</p>
                                <div class="relative">
                                    <input type="number" x-model="age" placeholder="25"
                                        @keyup.enter="calculateCalories()"
                                        class="w-full text-2xl font-bold bg-transparent border-none focus:ring-0 p-0 text-slate-800 placeholder:text-slate-200">
                                    <span class="absolute right-0 bottom-1 text-[9px] font-bold text-slate-300">YRS</span>
                                </div>
                            </div>
                            <!-- Height -->
                            <div
                                class="bg-slate-50 p-6 rounded-2xl border border-slate-100 focus-within:bg-white focus-within:border-brand transition-all">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">HEIGHT</p>
                                <div class="relative">
                                    <input type="number" x-model="height" placeholder="170"
                                        @keyup.enter="calculateCalories()"
                                        class="w-full text-2xl font-bold bg-transparent border-none focus:ring-0 p-0 text-slate-800 placeholder:text-slate-200">
                                    <span class="absolute right-0 bottom-1 text-[9px] font-bold text-slate-300">CM</span>
                                </div>
                            </div>
                            <!-- Weight -->
                            <div
                                class="bg-slate-50 p-6 rounded-2xl border border-slate-100 focus-within:bg-white focus-within:border-brand transition-all">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">WEIGHT</p>
                                <div class="relative">
                                    <input type="number" x-model="weight" placeholder="70"
                                        @keyup.enter="calculateCalories()"
                                        class="w-full text-2xl font-bold bg-transparent border-none focus:ring-0 p-0 text-slate-800 placeholder:text-slate-200">
                                    <span class="absolute right-0 bottom-1 text-[9px] font-bold text-slate-300">KG</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button @click="calculateCalories()"
                                class="px-12 py-3.5 bg-slate-800 text-white rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-brand transition-all shadow-md">Calculate
                                Energy</button>
                        </div>

                        <!-- Professional Results Layout -->
                        <div x-show="result" class="mt-12 grid grid-cols-1 md:grid-cols-12 gap-6"
                            x-transition:enter="transition-all duration-300">
                            <div
                                class="md:col-span-12 bg-slate-900 px-10 py-10 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-8">
                                <div>
                                    <h5 class="text-brand font-bold uppercase text-[10px] tracking-widest mb-3">Maintenance
                                        Calories</h5>
                                    <div class="flex items-baseline gap-3">
                                        <span class="text-5xl md:text-6xl font-bold text-white leading-none tracking-tight"
                                            x-text="result ? result.moderate : '0'"></span>
                                        <span class="text-lg font-bold text-slate-500 uppercase">kcal/day</span>
                                    </div>
                                </div>
                                <p
                                    class="text-slate-400 text-xs font-medium max-w-[200px] text-center md:text-right italic">
                                    Calculated for moderate physical activity (3-5 workouts/week).
                                </p>
                            </div>
                            <div
                                class="md:col-span-6 bg-slate-50 p-8 rounded-2xl border border-slate-100 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Basal Metabolic
                                    Rate</span>
                                <span class="text-2xl font-bold text-slate-800"
                                    x-text="result?.sedentary + ' KCAL'"></span>
                            </div>
                            <div
                                class="md:col-span-6 bg-slate-50 p-8 rounded-2xl border border-slate-100 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Athletic (Highly
                                    Active)</span>
                                <span class="text-2xl font-bold text-slate-800" x-text="result?.active + ' KCAL'"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Essential Health Script -->
    <script>
        function healthHub() {
            return {
                activeTab: 'calorie',
                chartGender: 'male',
                lookupHeight: '',
                lookupResult: null,
                gender: 'male',
                age: '',
                height: '',
                weight: '',
                result: null,

                weightDatabase: [{
                        cm: 137,
                        ft: '4-6',
                        f_min: 28.5,
                        f_max: 34.9,
                        m_min: 28.5,
                        m_max: 34.9
                    },
                    {
                        cm: 140,
                        ft: '4-7',
                        f_min: 30.8,
                        f_max: 37.6,
                        m_min: 30.8,
                        m_max: 38.1
                    },
                    {
                        cm: 142,
                        ft: '4-8',
                        f_min: 32.6,
                        f_max: 39.9,
                        m_min: 33.5,
                        m_max: 40.8
                    },
                    {
                        cm: 145,
                        ft: '4-9',
                        f_min: 34.9,
                        f_max: 42.6,
                        m_min: 35.8,
                        m_max: 43.9
                    },
                    {
                        cm: 147,
                        ft: '4-10',
                        f_min: 36.4,
                        f_max: 44.9,
                        m_min: 38.5,
                        m_max: 46.7
                    },
                    {
                        cm: 150,
                        ft: '4-11',
                        f_min: 39.0,
                        f_max: 47.6,
                        m_min: 40.8,
                        m_max: 49.9
                    },
                    {
                        cm: 152,
                        ft: '5-0',
                        f_min: 40.8,
                        f_max: 49.9,
                        m_min: 43.1,
                        m_max: 53.0
                    },
                    {
                        cm: 155,
                        ft: '5-1',
                        f_min: 43.1,
                        f_max: 52.6,
                        m_min: 45.8,
                        m_max: 55.8
                    },
                    {
                        cm: 157,
                        ft: '5-2',
                        f_min: 44.9,
                        f_max: 54.9,
                        m_min: 48.1,
                        m_max: 58.9
                    },
                    {
                        cm: 160,
                        ft: '5-3',
                        f_min: 47.2,
                        f_max: 57.6,
                        m_min: 50.8,
                        m_max: 61.6
                    },
                    {
                        cm: 163,
                        ft: '5-4',
                        f_min: 49.0,
                        f_max: 59.9,
                        m_min: 53.0,
                        m_max: 64.8
                    },
                    {
                        cm: 165,
                        ft: '5-5',
                        f_min: 51.2,
                        f_max: 62.6,
                        m_min: 55.3,
                        m_max: 68.0
                    },
                    {
                        cm: 168,
                        ft: '5-6',
                        f_min: 53.0,
                        f_max: 64.8,
                        m_min: 58.0,
                        m_max: 70.7
                    },
                    {
                        cm: 170,
                        ft: '5-7',
                        f_min: 55.3,
                        f_max: 67.6,
                        m_min: 60.3,
                        m_max: 73.9
                    },
                    {
                        cm: 173,
                        ft: '5-8',
                        f_min: 57.1,
                        f_max: 69.8,
                        m_min: 63.0,
                        m_max: 76.6
                    },
                    {
                        cm: 175,
                        ft: '5-9',
                        f_min: 59.4,
                        f_max: 72.6,
                        m_min: 65.3,
                        m_max: 79.8
                    },
                    {
                        cm: 178,
                        ft: '5-10',
                        f_min: 61.2,
                        f_max: 74.8,
                        m_min: 67.6,
                        m_max: 83.0
                    },
                    {
                        cm: 180,
                        ft: '5-11',
                        f_min: 63.5,
                        f_max: 77.5,
                        m_min: 70.3,
                        m_max: 85.7
                    },
                    {
                        cm: 183,
                        ft: '6-0',
                        f_min: 65.3,
                        f_max: 79.8,
                        m_min: 72.6,
                        m_max: 88.9
                    },
                    {
                        cm: 185,
                        ft: '6-1',
                        f_min: 67.6,
                        f_max: 82.5,
                        m_min: 75.3,
                        m_max: 91.6
                    },
                    {
                        cm: 188,
                        ft: '6-2',
                        f_min: 69.4,
                        f_max: 84.8,
                        m_min: 77.5,
                        m_max: 94.8
                    },
                    {
                        cm: 191,
                        ft: '6-3',
                        f_min: 71.6,
                        f_max: 87.5,
                        m_min: 79.8,
                        m_max: 98.0
                    }
                ],

                findIdealWeight() {
                    if (!this.lookupHeight) return;
                    let hStr = this.lookupHeight.toString();
                    let targetCm = 0;

                    if (hStr.includes('.') || hStr.includes('-') || hStr.includes("'")) {
                        let parts = hStr.split(/[.\-\']+/);
                        let ft = parseInt(parts[0]);
                        let inch = parts[1] ? parseInt(parts[1]) : 0;
                        targetCm = Math.round((ft * 30.48) + (inch * 2.54));
                    } else {
                        targetCm = parseInt(hStr);
                    }

                    let closest = this.weightDatabase.reduce((prev, curr) => {
                        return (Math.abs(curr.cm - targetCm) < Math.abs(prev.cm - targetCm) ? curr : prev);
                    });

                    let minKg = this.chartGender === 'male' ? closest.m_min : closest.f_min;
                    let maxKg = this.chartGender === 'male' ? closest.m_max : closest.f_max;

                    this.lookupResult = {
                        h: closest.cm + 'cm / ' + closest.ft.replace('-', '\'') + '\"',
                        weightKg: minKg + ' - ' + maxKg,
                        weightLb: Math.round(minKg * 2.204) + ' - ' + Math.round(maxKg * 2.204)
                    };
                },

                calculateCalories() {
                    if (!this.gender || !this.age || !this.height || !this.weight) return;
                    const w = parseFloat(this.weight);
                    const h = parseFloat(this.height);
                    const a = parseFloat(this.age);

                    let bmr = this.gender === 'male' ?
                        (10 * w + 6.25 * h - 5 * a + 5) :
                        (10 * w + 6.25 * h - 5 * a - 161);

                    this.result = {
                        bmr: Math.round(bmr),
                        sedentary: Math.round(bmr * 1.2),
                        moderate: Math.round(bmr * 1.55),
                        active: Math.round(bmr * 1.8)
                    };
                },

                resetCalorie() {
                    this.result = null;
                }
            };
        }
    </script>

    <!-- Flash Sale -->
    <section class="container mx-auto px-4 mt-16">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-full bg-gray-900 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13,10V2L5,14H11V22L19,10H13Z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Flash Sale</h2>
                </div>
                <!-- Countdown -->
                <div class="hidden md:flex items-center space-x-2" x-data="{ h: 0, m: 17, s: 56 }">
                    <div class="bg-brand text-white text-sm font-bold w-8 h-8 rounded-lg flex items-center justify-center"
                        x-text="h.toString().padStart(2, '0')"></div>
                    <span class="text-brand font-bold text-lg">:</span>
                    <div class="bg-brand text-white text-sm font-bold w-8 h-8 rounded-lg flex items-center justify-center"
                        x-text="m.toString().padStart(2, '0')"></div>
                    <span class="text-brand font-bold text-lg">:</span>
                    <div class="bg-brand text-white text-sm font-bold w-8 h-8 rounded-lg flex items-center justify-center"
                        x-text="s.toString().padStart(2, '0')"></div>
                </div>
            </div>
            <div class="flex space-x-2">
                <button
                    class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-brand transition"><svg
                        class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg></button>
                <button
                    class="w-10 h-10 rounded-lg bg-gray-900 text-white flex items-center justify-center hover:bg-gray-800 transition"><svg
                        class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg></button>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            @foreach ($flash_sale_products as $product)
                <div
                    class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all group flex flex-col h-full">
                    <div class="relative overflow-hidden aspect-square">
                        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
                            <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </a>
                        <button
                            class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-2 group-hover:translate-y-0 text-gray-500 hover:text-red-500 shadow-lg"
                            title="Add to Wishlist">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3
                                class="text-sm font-semibold text-gray-900 line-clamp-1 group-hover:text-brand transition mb-2">
                                <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-black text-gray-900">৳{{ $product->price }}</span>
                                @if ($product->discount_price)
                                    <span class="text-xs text-gray-400 line-through">৳{{ $product->discount_price }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-[10px] text-gray-400 font-bold mb-1">
                                <span>9/10 Sale</span>
                            </div>
                            <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="w-[90%] h-full bg-brand"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Todays For You! Tabs -->
    <section x-data="{ currentTab: 'Best Seller' }" class="container mx-auto px-4 mt-20">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Todays For You!</h2>
            <div class="flex flex-wrap items-center gap-2">
                @foreach (['Best Seller', 'Keep Stylish', 'Special Discount', 'Official Store', 'Coveted Product'] as $tab)
                    <button @click="currentTab = '{{ $tab }}'"
                        :class="currentTab === '{{ $tab }}' ? 'bg-gray-900 text-white shadow-xl scale-105' :
                            'bg-white text-gray-600 border border-gray-100 hover:border-brand'"
                        class="px-5 py-2 rounded-xl text-xs font-bold transition-all duration-300">
                        {{ $tab }}
                    </button>
                @endforeach
                <button @click="$dispatch('open-calorie-modal')"
                    class="px-5 py-2 rounded-xl text-xs font-bold bg-brand text-white shadow-lg shadow-brand/20 hover:scale-105 transition-all">
                    Calorie Calculator
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
            @foreach ($latest_products as $product)
                <div x-show="currentTab"
                    x-transition:enter="transition ease-out duration-300 delay-[{{ $loop->index * 50 }}ms]"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="bg-white rounded-3xl border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-500">
                    <div class="relative overflow-hidden aspect-square">
                        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
                            <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        </a>
                        <button @click="toggleWishlist({{ $product->id }})"
                            class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0 text-gray-500 hover:text-red-500 shadow-xl"
                            title="Add to Wishlist">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                        <div
                            class="absolute bottom-4 left-4 right-4 translate-y-12 group-hover:translate-y-0 transition-transform duration-500">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gray-900 text-white py-3 rounded-2xl font-bold text-sm shadow-xl hover:bg-brand transition transform active:scale-95 flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Add to Cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-base font-bold text-gray-900 line-clamp-1">
                                <a href="{{ route('product.show', $product->slug) }}"
                                    class="hover:text-brand transition">{{ $product->name }}</a>
                            </h3>
                        </div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">
                            {{ $product->category->name }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-black text-gray-900">৳{{ $product->price }}</span>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <span class="text-xs font-bold text-gray-400 ml-1">4.8</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('shop.index') }}"
                class="px-10 py-4 bg-white border-2 border-gray-900 text-gray-900 rounded-full font-black text-sm hover:bg-gray-900 hover:text-white transition-all transform hover:scale-105">View
                All Products</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mx-auto px-4 mt-24 mb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-gray-100 pt-16">
            <div class="flex space-x-5">
                <div class="shrink-0 w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-brand">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2">High Quality Guarantee</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">All products go through a strict quality control
                        process before they reach your doorstep.</p>
                </div>
            </div>
            <div class="flex space-x-5">
                <div class="shrink-0 w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-brand">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2">24/7 Fast Delivery</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">We provide fast and reliable shipping options to
                        ensure your orders arrive on time, every time.</p>
                </div>
            </div>
            <div class="flex space-x-5">
                <div class="shrink-0 w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-brand">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2">Secure Payment Options</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Your transaction security is our priority. We use
                        industry-standard encryption for all payments.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection

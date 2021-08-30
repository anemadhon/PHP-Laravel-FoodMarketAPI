<div class="flex items-center text-sm">
    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
        @if ((!$datas[0] && !$datas[1]) || (count($datas) === 2 && !$datas[0]))
            <svg class="w-full h-full rounded-full overflow-hidden bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        @endif
        @if ($datas[0])
            <img class="object-cover w-full h-full rounded-full" src="{{ asset('storage/'.$datas[0]) }}" alt="userss avatar" loading="lazy" />
        @endif
        @if (count($datas) === 3 && $datas[1])
            <img class="object-cover w-full h-full rounded-full" src="{{ $datas[1] }}" alt="userss avatar" loading="lazy" />
        @endif
        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
    </div>
    {{ count($datas) === 2 ? $datas[1] : $datas[2] }}
</div>
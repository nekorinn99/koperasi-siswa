<div class="w-full">
    @php
        $start = $get('start_date');
        $end = $get('end_date');
    @endphp

    @if($start && $end)
        <iframe 
            src="{{ route('preview.financial-transactions', ['start' => $start, 'end' => $end]) }}"
            class="w-full h-[600px] border rounded">
        </iframe>
    @else
        <div class="text-gray-500 text-center py-10">
            Pilih tanggal terlebih dahulu untuk melihat preview PDF.
        </div>
    @endif
</div>

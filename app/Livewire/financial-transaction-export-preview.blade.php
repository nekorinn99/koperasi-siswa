<div>
    <div class="space-y-4">
        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" wire:model="start_date" class="border rounded px-2 py-1 w-full">
            </div>
            <div class="flex-1">
                <label for="end_date">Tanggal Selesai</label>
                <input type="date" wire:model="end_date" class="border rounded px-2 py-1 w-full">
            </div>
        </div>

        @if($previewUrl)
            <div class="mt-4">
                <iframe src="{{ $previewUrl }}" class="w-full h-96 border"></iframe>
            </div>

            <button wire:click="downloadPdf" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                Download PDF
            </button>
        @endif
    </div>
</div>

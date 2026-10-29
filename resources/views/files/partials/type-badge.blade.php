@php
    $small = $small ?? false;
    $classes = [
        'image' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
        'pdf'   => 'bg-red-50 text-red-700 ring-red-200',
        'doc'   => 'bg-blue-50 text-blue-700 ring-blue-200',
        'excel' => 'bg-green-50 text-green-700 ring-green-200',
    ];
    $labels = [
        'image' => 'Imagen',
        'pdf'   => 'PDF',
        'doc'   => 'Documento',
        'excel' => 'Excel',
    ];
    $cls = $classes[$type] ?? 'bg-gray-50 text-gray-700 ring-gray-200';
    $label = $labels[$type] ?? strtoupper($type);
    $sizeClass = $small ? 'px-1.5 py-0.5 text-[10px]' : 'px-2 py-0.5 text-xs';
@endphp

<span class="inline-flex items-center font-medium rounded-full ring-1 ring-inset {{ $cls }} {{ $sizeClass }}">
    {{ $label }}
</span>
@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-800 border-gray-700 text-gray-100 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm']) }}>

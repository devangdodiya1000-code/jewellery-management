<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-[#D4AF37] border border-[#D4AF37] rounded-md font-semibold text-[10px] text-[#0A0A0A] uppercase tracking-[3.5px] hover:bg-[#A8871A] focus:bg-[#A8871A] focus:outline-none focus:ring-2 focus:ring-[rgba(212,175,55,0.35)] focus:ring-offset-0 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>

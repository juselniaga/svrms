<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-accent border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent-light hover:text-accent focus:bg-accent-light active:bg-accent focus:outline-none focus:ring-2 focus:ring-primary-light focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

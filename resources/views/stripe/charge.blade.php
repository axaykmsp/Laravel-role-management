<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stripe Payment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form id="checkout-form" class="mt-6 space-y-6">
                        {{ csrf_field() }}

                        <div>
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full" required autofocus autocomplete="amount" />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>
                        <!--<label for="amount">Amount (in cents):</label>
                        <input type="text" name="amount" id="amount" required>-->

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" required autofocus autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button id="checkout-button">{{ __('Checkout') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        document.getElementById('checkout-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            const response = await fetch("{{ route('stripe.charge.create') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    amount: document.getElementById('amount').value,
                    email: document.getElementById('email').value,
                }),
            });

            const session = await response.json();

            // Redirect to Stripe Checkout
            const { error } = await stripe.redirectToCheckout({ sessionId: session.id });
            if (error) {
                console.error("Error redirecting to checkout:", error);
            }
        });
    </script>
    <!--<script src="https://js.stripe.com/v3/"></script>-->
</x-app-layout>

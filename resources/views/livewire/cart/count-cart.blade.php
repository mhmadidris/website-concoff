<div class="cart-badge">
    @if ($cartCount >= 1)
        {{ $cartCount }}
        <style>
            .cart-badge {
                display: inline-block;
                min-width: 2em;
                max-height: 2em;
                /* em unit */
                padding: 0.3em;
                /* em unit */
                border-radius: 50%;
                font-size: 10px;
                text-align: center;
                background: #29a867;
                color: #fefefe;
                margin-left: -10px;
                margin-top: 2px;
            }

        </style>
    @endif
</div>

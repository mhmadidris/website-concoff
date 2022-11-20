<div class="input-group border p-2 w-50 mx-lg-auto mt-3 mx-3" style="border-radius: 10px;">
    <style>
         .btn-add {
            display: inline-block;
            min-width: 2.5em;
            max-height: 2.5em; /* em unit */
            border-radius: 50%;
            font-size: 11px;
            text-align: center;
            background: #bf87ff;
            color: #fefefe;
        }

         .btn-minus {
            display: inline-block;
            min-width: 2.5em;
            max-height: 2.5em; /* em unit */
            border-radius: 50%;
            font-size: 11px;
            text-align: center;
            border: 1px solid #ADB2B8;
            color: #ADB2B8;
            font-weight: bold;
        }

        @media (min-width:280px) and (max-width: 576px){

             .btn-add {
                display: inline-block;
                min-width: 1em;
                max-height: 1em; /* em unit */
                border-radius: 50%;
                font-size: 11px;
                padding-bottom: 20px;
                background: #bf87ff;
                color: #fefefe;
            }

             .btn-minus {
                display: inline-block;
                min-width: 1em;
                max-height: 1em; /* em unit */
                border-radius: 50%;
                font-size: 11px;
                padding-bottom: 20px;
                border: 1px solid #ADB2B8;
                color: #ADB2B8;
                font-weight: bold;
            }

             .input-number {
                font-size: 11px;
            }
        }
    </style>
    <span class="input-group-btn">
        <div wire:click="decrement" class="btn btn-minus pb-lg-3 px-lg-1 px-2">
            -
        </div>
    </span>
    <input type="text" name="jumlah" class="form-control input-number text-center border-0"
        max="{{ $maxProduct->stock }}" value="{{ $count }}" style="background-color: transparent;"
        autocomplete="off" readonly />
    <span class="input-group-btn">
        <div wire:click="increment" class="btn btn-add pb-lg-3 px-lg-1 px-2">
            +
        </div>
    </span>
</div>

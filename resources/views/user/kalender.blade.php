@extends('user.layout.main')

@section('content')
    <div class="h-full w-full p-10">
        <div class="head-kalender">
            @for ($j = 0; $j < 1; $j++)
                <div class="row-kalender">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="kotak-kepala">
                            {{$daftar_hari[$i]}}
                        </div>
                    @endfor
                </div>
            @endfor
        </div>
        <div class="body-kalender">
            @php
                $mode = 0;
                //mode = 0 bukan kalender sekarang
                //mode = 1 kalender sekarang
            @endphp

            @for ($j = 0; $j < 6; $j++)
                <div class="row-kalender">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="kotak-kalender @if($mode == 0) kalender-lain @endif">
                            {{$start}}
                        </div>

                        @php
                            if($mode == 0) {
                                if ($start == $tgl_terakhir_bulan_lalu) {$start = 1; $mode = 1;}
                                else $start += 1;
                            }
                            else {
                                if ($start == $tgl_terakhir_bulan_ini) {$start = 1;$mode = 0;}
                                else $start+= 1;
                            }
                        @endphp
                    @endfor
                </div>
            @endfor
        </div>
    </div>
@endsection

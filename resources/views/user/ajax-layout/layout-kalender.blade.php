<div class="p-6 pl-10" style="width: 100%;height:100%;display:flex;justify-content:center;flex-direction:column">
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
            if ($start == 1) $mode = 1;
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

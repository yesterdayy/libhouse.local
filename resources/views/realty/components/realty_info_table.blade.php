<div class="d-table realty-col-info-table" style="width: {{ count($realty_info_table[0]) * 25 }}%;">
    @foreach ($realty_info_table as $rinfo)
        <div class="d-table-row">

            @foreach ($rinfo as $key => $item)
                <div class="d-table-cell realty-col-info-wrap">
                    <b>{{ $key }}:</b> {{ $item }}
                </div>
            @endforeach

        </div>
    @endforeach
</div>

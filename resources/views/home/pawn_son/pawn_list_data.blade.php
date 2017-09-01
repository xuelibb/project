<table class="table table-bordered table-hover">
    <tbody><tr class="active">
        <th width="170">域名</th>
        <th width="100">授信额度</th>
        <th>操作</th>
    </tr>
        @if(!empty($data))
        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v['lend_goods']}}</td>
                @if($v['lend_worth']==0)
                    <td>#</td>
                @else
                    <td>{{$v['lend_worth']}}</td>
                @endif
                @if($v['status']==0)
                    <td><a href="#" disabled="disabled">暂不可操作</a></td>
                    @elseif($v['status']==1 && $v['borrow_state']==0)
                <td><a href="borrow_insert?lend_goods={{base64_encode($v['lend_goods'])}}&lend_worth={{base64_encode($v['lend_worth'])}}">申请借款</a></td>
                    @else
                    <td><a href="#" disabled="disabled">完成借款</a></td>
                    @endif
            </tr>
        @endforeach
        @else
        <tr class="not-hover"><td colspan="6" style="text-align: center;height:820px"><div class="no_record"></div>暂无记录!</td></tr>
        @endif
    </tbody></table>
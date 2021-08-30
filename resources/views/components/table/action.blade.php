<a href="{{ route($datas[0], $datas[3]) }}"><span class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-600 hover:text-blue-900">View</span></a>
<a href="{{ route($datas[1], $datas[3]) }}"><span class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-600 hover:text-indigo-900">Edit</span></a>
<form class="inline-block" action="{{ route($datas[2], $datas[3]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
    {!! method_field('delete') . csrf_field() !!}
    <input type="submit" class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full text-red-600 hover:text-red-900" value="Delete">
</form>
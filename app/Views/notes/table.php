<div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12">
                <!--END CONTENT WIDGET-->
                <div class="widget-content widget-content-area br-8">
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                <thead>
                                        <tr>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Created At</th>
                                                <th class="no-content">Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        @foreach($notes as $note )
                                        <tr>
                                                <td>{{$note['id']}}</td>
                                                <td>{{substr($note['title'],0,20)}}</td>
                                                <td>{{date('d M',strtotime($note['created_at']))}}</td>
                                                <td>
                                                        <div class="action-btns">
                                                                <a href="{{str_replace('index.php/','',url_to('Notes::show/$1',$note['id']))}}" class="action-btn btn-view bs-tooltip me-1" data-toggle="tooltip" data-placement="top" title="View">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                                <circle cx="12" cy="12" r="3"></circle>
                                                                        </svg>
                                                                </a>
                                                                <a href="{{str_replace('index.php/','',url_to('Notes::edit/$1',$note['id']))}}" class="action-btn btn-edit bs-tooltip me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                                        </svg>
                                                                </a>
                                                                <a href="#" class="action-btn btn-delete bs-tooltip" onClick="deleteNote('{{$note['id']}}');" data-id="{{$note['id']}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel">
                                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                        </svg>

                                                                </a>


                                                        </div>

                                                </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </div>
        </div>
</div>
<!--END CONTENT WIDGET-->

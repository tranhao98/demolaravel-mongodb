@if (!$comments->isEmpty())
    @foreach ($comments as $cmt)
        <?php $last_id = $cmt['_id']; ?>
        <li>
            <div class="feature-item w-100" style="margin-bottom:15px;">
                <div class="row">
                    <div class="left-icon col-2">
                        <img src="../images/features-first-icon.png" alt="First One">
                    </div>
                    <div class="right-content col-10">
                        <input type="hidden" name="idCmt" id="idCmt" value="{{ $cmt['_id'] }}">
                        <h4>{{ $cmt->users->name }}
                            <small>{{ date('d/m/Y H:i A', strtotime($cmt['created_at'])) }}</small>
                            @if ($cmt['idUser'] == Auth::id())
                                <span class="float-right btn_delete_cmt"><a class="text-danger" style="cursor: pointer"><i
                                            class="pe-7s-trash" style="font-size: 28px"></i></a></span>
                                <span class="float-right btn_edit_cmt mr-2"><a class="text-info" style="cursor: pointer"><i
                                            class="pe-7s-note" style="font-size: 28px"></i></a></span>

                            @endif
                        </h4>
                        @if (Session::get('edit') == $cmt['_id'])
                            <div class="contact-form">
                                <form id="editComment" action="javascript:void(0);" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <textarea name="message" @if (isset($cmt['comment'])) value="{{ $cmt['comment'] }}" @endif rows="6" id="message_edit"
                                                    placeholder="Message">{{ $cmt['comment'] }}</textarea>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit-edit"
                                                    class="main-button">Edit</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <p><em>{{ $cmt['comment'] }}</em> </p>
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
    @if ($count_comment > 5)
        <div id="tabs">
            <div id="load_more_btn" data-id={{ $last_id }} class="main-rounded-button"><a
                    style="cursor: pointer;">Load
                    More</a></div>
        </div>
    @endif
@endif

<div class="container">
    <div class="row">
        <h2 class="sec-heading">Why you should sign up?</h2>
        <div class="spacer50"></div>
        <div class="col-sm-3 why-box"> <img src="{{ asset('public/assets/imgs/b1ic.png') }}" />
            <h4>Inbox</h4>
            <p>{{ (isset($site_settings['home_section4_inbox_text']) && !empty($site_settings['home_section4_inbox_text'])) ? $site_settings['home_section4_inbox_text'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.' }}</p>
        </div>
        <div class="col-sm-3 why-box"> <img src="{{ asset('public/assets/imgs/b2ic.png') }}" />
            <h4>Collaborate</h4>
            <p>{{ (isset($site_settings['home_section4_collaborate_text']) && !empty($site_settings['home_section4_collaborate_text'])) ? $site_settings['home_section4_collaborate_text'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.' }}
            </p>
        </div>
        <div class="col-sm-3 why-box"> <img src="{{ asset('public/assets/imgs/b3ic.png') }}" />
            <h4>Shortlist and Finalize Vendors</h4>
            <p>{{ (isset($site_settings['home_section4_finalize_vendors_text']) && !empty($site_settings['home_section4_finalize_vendors_text'])) ? $site_settings['home_section4_finalize_vendors_text'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.' }}
            </p>
        </div>
        <div class="col-sm-3 why-box"> <img src="{{ asset('public/assets/imgs/b4ic.png') }}" />
            <h4>Checklist</h4>
            <p>{{ (isset($site_settings['home_section4_checklist_text']) && !empty($site_settings['home_section4_checklist_text'])) ? $site_settings['home_section4_checklist_text'] : ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.' }}
           </p>
        </div>
        <div class="clearfix"></div>
        <div class="spacer50"></div> @if (empty(auth()->guard('user')->id()))
        <center><a href="javascript:void(0)" onclick="user_registration_popup()" class="btn-pink">Signup</a></center> @endif </div>
</div>
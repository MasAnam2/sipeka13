<img width="70px" height="70px" class="company-logo" 
@if(isset($excel))
src="{{ companyLogoExport() }}" 
@else
src="{{ asset(companyLogoExport()) }}" 
@endif
alt="{{ companyName() }}">
<h2 class="text-center">{{ companyName() }}</h2>
<p class="text-center">{{ companyAddress() }} <br>Contact : {{ companyContact() }}, Email : {{ companyEmail() }}</p>
<hr>
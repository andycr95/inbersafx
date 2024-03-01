<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        
        <a href="{{route('user.profile')}}" class="headerButton">
            <ion-icon name="person-circle"></ion-icon>
        </a>
         
    </div>
    
    
     <a href="{{route('home')}}">
    <div class="pageTitle">
        {{-- <img src="{{asset('asset/theme3/assets/img/logo.png')}}" alt="logo" class="logo"> --}}
        <img src="{{ getFile('logo', @$general->whitelogo) }}" alt="logo" class="logo">
    </div>
    </a>
    <div class="right">
        <a href="javascript:void(0)" class="headerButton transactionLogBtn">
            <ion-icon class="icon" name="notifications"></ion-icon>
        </a>
        
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
        
    </div>
</div>
<!-- * App Header -->

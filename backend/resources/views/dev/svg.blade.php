<div style='height: 0; width: 0; position: absolute; visibility: hidden'>
    @include('components.svg')
</div>

<style>
    
    html{
        background-color: #fcc;
    }
    
    .icon {
        display: inline-block;
        margin: 15px;
        text-align: center;
    }

    svg {
        width: 100px;
        height: 100px;
        margin-bottom: 15px;
    }

</style>

<div class="container">

    <div class="icons">
        <div class="row">
            @foreach($files as $file)
                <div class="icon">
                    <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use xlink:href='#{{ substr($file, 0, -4) }}'></use>
                    </svg>
                    <div class="name">#{{ substr($file, 0, -4) }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script setup>
    const el = document.body;
    el.classList.remove("login-page") ;
    el.classList.add("sidebar-mini");
</script>


<template>
    
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link"><h6><b>QMAX MIS SYSTEM</b></h6></a>
            </li>
           
        </ul>
       
    </nav>

</template>

<script>
    export default {
        name: 'Appheader',
        props: { }
    }
</script>
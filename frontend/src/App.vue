<template>
  <div id="app">
    <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">Challenge 2</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
          aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <router-link to="/news" class="nav-link">News</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container py-3">
            <router-view />
    </div>
  </div>
</template>

<style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }
</style>
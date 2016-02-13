<?php

Map::get('/', 'welcome#index');
Map::get('/404', 'error_controller#error_index');
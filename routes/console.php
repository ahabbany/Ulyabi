<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:clean-carts')->daily();

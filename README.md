Disatance and Time Bundle
=========================

This bundle adds some useful time and distance TWIG filters

Configuration
-------------

By default all distances are assumed to be normalized as meters, you can change
this value in the configuration as follows:

    dtl_time_distance:
        normalized_distance_unit: m

format_distance
---------------

Convert the given normalized distance to the specified unit:

    {# Format 20km (in meters) to miles #}
    {{ 2000|format_distance('miles') }}

    {# Format 20km (in meters) to foot with a precision of 4 #}
    {{ 2000|format_distance('ft', 4) }}

seconds_to_stopwatch
--------------------

Format a given number of seconds as "stopwatch" (hh:mm:ss):

    {# 1 hour will display as 01:00:00 #}
    {{ 3600|seconds_to_stopwatch }}

    {# 2 seconds will display as 00:00:02 #}
    {{ 2|seconds_to_stopwatch }}

    {# 1 week will display as 168:00:00 #}
    {{ 604800|seconds_to_stopwatch }}
 
average_pace
------------

Format average pace (i.e. time per distance unit) for given time and distance:

    {# If you ran 10k in 47 minutes you would do 00:07:34 - 7 minutes, 34 seconds per mile #}
    {{ 2820|average_pace(10, 'miles') }}

    {# Default is km, but will accept any of the distance units #}
    {{ 2820|average_pace(10) }}

average_speed
-------------

Format average speed acccording to given distance unit:

    {# If you ran 10k in 47 minutes you run at 7.93 miles per hour #}
    {{ 2820|average_speed(10, 'miles') }}

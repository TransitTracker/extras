<?php

use Carbon\Carbon;
use FelixINX\TransitRealtime\FeedEntity;
use FelixINX\TransitRealtime\FeedHeader;
use FelixINX\TransitRealtime\FeedMessage;
use FelixINX\TransitRealtime\TripDescriptor;
use FelixINX\TransitRealtime\TripUpdate\StopTimeEvent;
use FelixINX\TransitRealtime\TripUpdate\StopTimeUpdate;
use FelixINX\TransitRealtime\TripUpdate\StopTimeUpdate\ScheduleRelationship;
use FelixINX\TransitRealtime\TripUpdate;

$feed = new FeedMessage();

$header = new FeedHeader();
$header->setGtfsRealtimeVersion('2.0');
$header->setIncrementality(0); // FULL_DATASET
$header->setTimestamp(Carbon::now()->getTimestamp());
$feed->setHeader($header);

$feedEntity = new FeedEntity();
$feedEntity->setId('22106326');
$feed->setEntity([$feedEntity]);

$tripUpdate = new TripUpdate();
$tripUpdate->setTimestamp(Carbon::now()->subSeconds(15)->getTimestamp());

$tripDescriptor = new TripDescriptor();
$tripDescriptor->setTripId('221066326');
$tripDescriptor->setStartTime('08:12:00');
$tripDescriptor->setStartDate(Carbon::now()->format('Ymd'));
$tripDescriptor->setRouteId('49E');
$tripUpdate->setTrip($tripDescriptor);

$stopTimeUpdate1 = new StopTimeUpdate();
$stopTimeUpdate1->setStopSequence(17);
$stopTimeEventArrival = new StopTimeEvent();
$stopTimeEventArrival->setTime(Carbon::parse('	12:27:00')->getTimestamp());
$stopTimeUpdate1->setArrival($stopTimeEventArrival);
$stopTimeEventDeparture = new StopTimeEvent();
$stopTimeEventDeparture->setTime(Carbon::parse('	12:27:00')->getTimestamp());
$stopTimeUpdate1->setDeparture($stopTimeEventDeparture);
$stopTimeUpdate1->setStopId('54324');
$stopTimeUpdate1->setScheduleRelationship(ScheduleRelationship::SCHEDULED);

$stopTimeUpdate2 = new StopTimeUpdate();
$stopTimeUpdate2->setStopSequence(16);
$stopTimeEventArrival = new StopTimeEvent();
$stopTimeEventArrival->setTime(Carbon::parse('	12:25:00')->getTimestamp());
$stopTimeUpdate2->setArrival($stopTimeEventArrival);
$stopTimeEventDeparture = new StopTimeEvent();
$stopTimeEventDeparture->setTime(Carbon::parse('	12:25:00')->getTimestamp());
$stopTimeUpdate2->setDeparture($stopTimeEventDeparture);
$stopTimeUpdate2->setStopId('60312');
$stopTimeUpdate2->setScheduleRelationship(ScheduleRelationship::SCHEDULED);

$tripUpdate->setStopTimeUpdate([$stopTimeUpdate2, $stopTimeUpdate1]);
$feedEntity->setTripUpdate($tripUpdate);

file_put_contents('storage/app/public/test.json', $feed->serializeToJsonString());
file_put_contents('storage/app/public/test.pb', $feed->serializeToString());

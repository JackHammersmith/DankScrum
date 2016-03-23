<?php

use Illuminate\Database\Seeder;
use App\Ticket;
use Faker\Factory as Faker;


class TicketsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Ticket::create([
            'title' => 'Ticket 1',
            'user_id' => 1,
            'project_id' => 1,
            'priority' => 0.5,
            'progress' => 0.4,
            'est_time' => 1.2,
            'status_id' => 1,
            'severity_id' => 1,
            'ticket_type_id' => 1,
            'description' => $faker->text,
            'assignee_id' => 2,
        ]);

        Ticket::create([
            'title' => 'Ticket 2',
            'user_id' => 2,
            'project_id' => 1,
            'priority' => 0.4,
            'progress' => 0.4,
            'est_time' => 1.2,
            'status_id' => 1,
            'severity_id' => 1,
            'ticket_type_id' => 1,
            'description' => $faker->text,
            'assignee_id' => 2,
        ]);

        Ticket::create([
            'title' => 'Ticket 3',
            'user_id' => 2,
            'project_id' => 1,
            'priority' => 0.3,
            'progress' => 0.4,
            'est_time' => 1.2,
            'status_id' => 1,
            'severity_id' => 1,
            'ticket_type_id' => 1,
            'description' => $faker->text,
            'assignee_id' => 2,
        ]);

        Ticket::create([
            'title' => 'Ticket 4',
            'user_id' => 1,
            'project_id' => 1,
            'priority' => 0.3,
            'progress' => 0.4,
            'est_time' => 1.2,
            'status_id' => 1,
            'severity_id' => 1,
            'ticket_type_id' => 1,
            'description' => $faker->text,
            'assignee_id' => 3,
        ]);

    }
}

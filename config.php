<?php

/*
 * The MIT License
 *
 * Copyright 2017 DarkCloud.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
//Database info
$debug = true;
$dbserver = "localhost";
$dbname = "";
$dbuser = "";
$dbpassword = "";
$dbport = "";
/*
 * The following is information about your FC, including ID. If unsure how to find your FC ID, visit your FC on lodestone and it should display the FC ID in the URL.
 * Example, http://na.finalfantasyxiv.com/lodestone/freecompany/9229001536389032942, As you can see 9229001536389032942 is the FC ID number.
 */
$fc_id = '9229001536389032942';

/*
 * Select how many members to view per page.
 */
$perPage = 30;

/*
 * Job types, and images. You can easily change the images by either overriding the images currently in the images folder OR by changing the array element associated with them.
 * IE "images/secondary/paladin.png" or "images/bleh/herpaderpa.png"
 */

$jobs = array(
    array("name" => "Paladin", "type" => "battle", "image" => "images/paladin.png"),
    array("name" => "Warrior", "type" => "battle", "image" => "images/warrior.png"),
    array("name" => "Dark Knight", "type" => "battle", "image" => "images/dark_knight.png"),
    array("name" => "Monk", "type" => "battle", "image" => "images/monk.png"),
    array("name" => "Dragoon", "type" => "battle", "image" => "images/dragoon.png"),
    array("name" => "Ninja", "type" => "battle", "image" => "images/ninja.png"),
    array("name" => "Samurai", "type" => "battle", "image" => "images/samurai.png"),
    array("name" => "White Mage", "type" => "battle", "image" => "images/white_mage.png"),
    array("name" => "Scholar", "type" => "battle", "image" => "images/scholar.png"),
    array("name" => "Astrologian", "type" => "battle", "image" => "images/astrologian.png"),
    array("name" => "Bard", "type" => "battle", "image" => "images/bard.png"),
    array("name" => "Machinist", "type" => "battle", "image" => "images/machinist.png"),
    array("name" => "Black Mage", "type" => "battle", "image" => "images/black_mage.png"),
    array("name" => "Summoner", "type" => "battle", "image" => "images/summoner.png"),
    array("name" => "Red Mage", "type" => "battle", "image" => "images/red_mage.png"),
    array("name" => "Carpenter", "type" => "hand", "image" => "images/carpenter.png"),
    array("name" => "Blacksmith", "type" => "hand", "image" => "images/blacksmith.png"),
    array("name" => "Armorer", "type" => "hand", "image" => "images/armorer.png"),
    array("name" => "Goldsmith", "type" => "hand", "image" => "images/goldsmith.png"),
    array("name" => "Leatherworker", "type" => "hand", "image" => "images/leatherworker.png"),
    array("name" => "Weaver", "type" => "hand", "image" => "images/weaver.png"),
    array("name" => "Alchemist", "type" => "hand", "image" => "images/alchemist.png"),
    array("name" => "Culinarian", "type" => "hand", "image" => "images/culinarian.png"),
    array("name" => "Miner", "type" => "hand", "image" => "images/miner.png"),
    array("name" => "Botanist", "type" => "hand", "image" => "images/botanist.png"),
    array("name" => "Fisher", "type" => "hand", "image" => "images/fisher.png"),
    array("name" => "Gladiator", "type" => "battle", "image" => "images/gladiator.png"),
    array("name" => "Pugilist", "type" => "battle", "image" => "images/pugilist.png"),
    array("name" => "Thaumaturge", "type" => "battle", "image" => "images/thaumaturge.png"),
    array("name" => "Arcanist", "type" => "battle", "image" => "images/arcanist.png"),
    array("name" => "Rogue", "type" => "battle", "image" => "images/rogue.png"),
    array("name" => "Archer", "type" => "battle", "image" => "images/archer.png"),
    array("name" => "Lancer", "type" => "battle", "image" => "images/lancer.png"),
    array("name" => "Marauder", "type" => "battle", "image" => "images/marauder.png"),
    array("name" => "Conjurer", "type" => "battle", "image" => "images/conjurer.png"),
);

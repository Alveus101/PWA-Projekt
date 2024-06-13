-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 01:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `welt`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_croatian_ci NOT NULL,
  `display_name` varchar(64) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `display_name`) VALUES
(1, 'it', 'IT'),
(2, 'food', 'FOOD'),
(3, 'science', 'SCIENCE');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `permission` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `name`, `surname`, `username`, `password`, `permission`) VALUES
(1, 'Admin', 'Adminovic', 'Admin', '$2y$10$qe8JGZooZa4Ei/5uajllUOzzRje8tx76jRbVoiTvM8QS2ZUKxCqz.', 1),
(2, 'Guest', 'Guestovic', 'Guest', '$2y$10$5HFAlIx5coGIF/nS99FR9OYw98P/o28J22RlMDthgSeKepvnTLSoy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `date` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `title` varchar(64) COLLATE utf8_croatian_ci NOT NULL,
  `short_content` text COLLATE utf8_croatian_ci NOT NULL,
  `content` text COLLATE utf8_croatian_ci NOT NULL,
  `category` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `image_name` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `archive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `short_content`, `content`, `category`, `image_name`, `archive`) VALUES
(1, '13.06.2024.', 'Hackers Exploit Firewall Bug', 'Chinese hackers breached 20,000 Fortinet FortiGate systems to run espionage against government', 'Chinese hackers breached 20,000 Fortinet FortiGate systems worldwide in 2022 and 2023 and used that access to target Western governments and private defense companies.\r\n\r\nFortiGate is Fortinet\'s firewall and network security platform. In February, the company confirmed a vulnerability that hackers exploited to install \"Coathanger\" malware and infiltrate government, service providers, consultancy, manufacturing, and large critical infrastructure organizations.\r\n\r\nAs BleepingComputer reports, the Dutch Military Intelligence and Security Service (MIVD) found that the hackers attempted to run a \"political espionage campaign targeting the Netherlands and its allies.\" In a two-month period prior to Fortigate\'s disclosure, hackers infected at least 14,000 devices, according to the MIVD.\r\n\r\nIn the months since, an investigation from MIVD and the Dutch National Cyber Security Center (NCSC) \"has shown that the Chinese cyber espionage campaign appears to be much more extensive than previously known.\" They\'re calling for \"extra attention to this campaign.\"\r\n\r\nCoathanger malware can stay on a device even after a security update, giving the Chinese hackers \"permanent access to the systems.\"', 'it', '06-13-2024_09-40-45.webp', 0),
(2, '13.06.2024.', 'No More Custom GPTs In Copilot', 'Microsoft says the move will allow it to \'focus on different AI features that improve Copilot Pro.\'', 'If you\'ve taken full advantage of Copilot Pro, you\'ve likely messed around with custom Copilot GPTs. Hopefully you had fun because Microsoft is disabling the feature come July 10.\r\n\r\nThe announcement, spotted by Windows Latest, came in via email to Copilot Pro subscribers. Microsoft says it\'s \"removing Copilot GPT Builder from Copilot Pro beginning on July 10, 2024...to focus on different AI features that improve Copilot Pro.\"\r\n\r\nAt that point, \"you will no longer be able to create and configure Copilot GPTs in Copilot Pro, and any Copilot GPTs that you created will no longer be accessible. If you created Copilot GPTs, you can save those custom instructions,\" Microsoft says.\r\n\r\nCopilot GPTs arrived in January alongside Copilot Pro, a paid version of its Copilot AI assistant that costs $20 per month for access to more features, including the latest GPT models from OpenAI. The Copilot GPT Builder lets people create custom GPTs using a \"set of simple prompts.\"\r\n\r\nMicrosoft published an FAQ on its support site to clarify some details. The GPT features in Copilot will remain available for commercial and enterprise users, so the tech isn\'t disappearing entirely. It just won\'t be available in the consumer-facing Copilot Pro. Microsoft also confirmed that it\'s deleting all Copilot GPTs made by Copilot Pro users and that any data collected by the Copilot GPT builder will also be deleted.', 'it', '06-13-2024_09-45-21.jpg', 0),
(3, '13.06.2024.', 'X to Hide Likes to Stop Shame', 'Elon Musk is making another big change at X: hiding users\' liked tweets from public view.', 'The change, which is rolling out this week, is intended to protect user privacy, according to X\'s engineering team. \"You will still be able to see posts you have liked (but others cannot),\" they said.\r\n\r\nAs a result, users can expect Twitter to remove the \"Likes\" tab from people\'s profiles. The tab was often a useful way to find out if a celebrity, including Musk, liked a controversial tweet. But last month, Twitter engineer Haofei Wang mentioned that the company would make likes private to stop potential shaming. \r\n\r\n\"Public likes are incentivizing the wrong behavior. For example, many people feel discouraged from liking content that might be \'edgy\' in fear of retaliation from trolls, or to protect their public image,\" Wang said at the time. \"Soon you\'ll be able to like without worrying who might see it.\"\r\n\r\nOn Tuesday, Musk echoed that sentiment. \"Important to allow people to like posts without getting attacked for doing so!\" he tweeted.\r\n\r\nIn the early days of Twitter, many people used the like button to bookmark tweets for future reference. That sometimes gave the false impression that they endorsed the message, especially after Twitter changed the like icon from a star to a heart in 2015. Three years later, Twitter finally rolled out a formal Bookmark feature, which lets people tag tweets without alerting the author or making the saves public.\r\n\r\nDespite the demise of the like tab, like counts will remain on tweets, according to another Twitter engineer, Enrique Barragan. But only the author of a tweet will be able to see who liked a post.', 'it', '06-13-2024_09-49-23.webp', 0),
(4, '13.06.2024.', 'New Starlink Dish Price', 'SpaceX is slashing the price of its new V4 Starlink dish from $599 to $499.', ' And it\'s rolling out a new “regional savings” program that brings the dish’s cost to $299 for new subscribers.\r\n\r\nThe $499 price popped up today on Starlink\'s official service plan and checkout pages.\r\n\r\nBest Buy and Home Depot are also offering the Starlink dishes at $499, noting a $100 price cut. But it’s not clear if the new price is permanent.\r\n\r\nSpaceX didn’t immediately respond to a request for comment. But it looks like the company is embarking on an aggressive pricing strategy to reel in new customers in the US. On the same day, the official Starlink site also began offering a $200 “regional savings” discount on top of the $499 price for new subscribers joining the residential service plan.\r\n\r\n“In the United States, new orders in certain regions are eligible for a one-time savings in areas where Starlink has abundant network availability,” the company wrote in a new support page listing. “$200 will be removed from your Starlink kit price when ordering on Starlink.com, and if activated after purchasing from a retailer, a $200 credit will be applied.”\r\n\r\nThe same listing also provides a map showing that the regional savings program will apply to new customers in 27 states, including California, New York, and Florida. \r\n\r\nTo prevent users in other states from abusing the savings program, SpaceX’s support page adds: “Customers who change their service address to an address that is not a regional savings area will be billed the amount of the regional savings.” Users are also barred from transferring the Starlink account to another customer “until 120 days after the date the order is placed.”\r\n\r\nSpaceX has tried a variety of strategies to attract more Starlink users recently, including offering the Starlink dish at $349 for select users in four US states and selling refurbished Starlink dishes for $399, although both programs have since been phased out.\r\n', 'it', '06-13-2024_09-53-24.webp', 0),
(5, '13.06.2024.', 'Discord On PS5', 'Sony is improving Discord integration on the PS5 so you can join voice calls directly from console. ', 'Discord support on PS5 currently requires you to manually transfer a call to a console by using the Discord app on mobile or PC. Sony is now rolling out an update that integrates Discord directly into the PS5 dashboard so you can select the server or DM group you want to join.\r\n\r\nThe update is rolling out gradually over the coming weeks, starting with PS5 owners in Japan and Asia followed by Europe, Australia, New Zealand, the Middle East, and then finally the US and Canada. You’ll need to update your PS5 to the latest system software to get this new Discord integration, and a PlayStation Network account will need to be linked to your Discord account, too.\r\n\r\n“To start, select the Discord tab in Game Base within the PS5 Control Center and choose the Discord server or DM group you’d like to join,” explains Sabrina Meditz, senior director of product management for the PlayStation platform experience. “Then, select your preferred voice channel. This will reveal more details, such as who is already in the channel chatting. You’ll also receive a PS5 console notification when another Discord user calls you, allowing you to join right away.”\r\n\r\nThis latest PS5 update puts the Discord experience nearly on par with what Microsoft offers on the Xbox. Microsoft first offered Discord support on Xbox in July 2022 for testers, before then rolling out an improved experience without the need for a phone in November 2022. Discord on Xbox was also updated to let you stream your gameplay to friends last year.\r\n\r\nSony is also rolling out the ability to share your PlayStation Network profile on any messaging or social app, with a new share profile option in the PlayStation mobile app next week. The feature generates a shareable link or QR code so people can easily add you as a friend.', 'it', '06-13-2024_10-04-46.webp', 1),
(6, '13.06.2024.', 'PC Adapter for Sony\'s PS VR2', 'After confirming it was exploring PC compatibility earlier this year, Sony creates a PS VR2 adapter.', 'Sony\'s PlayStation VR2 headset and controllers may soon be compatible with PCs via a new adapter, if a Sony filing with a South Korean regulator is any indication.\r\n\r\nEarlier this week, a PC adapter for the PS VR2 was certified with the Korean National Radio Research Agency, which examines, tests, and certifies tech products. The adapter now has a certification number, which suggests a public release could be on the horizon. The PC adapter for the VR2 would mark the first time Sony has enabled full PC support for its VR devices.\r\n\r\nThe PS VR 2 is currently only compatible with the PlayStation 5 console. It\'s not fully compatible with PCs and won\'t connect to a PS4 console. Sony\'s original PS VR headset will work with either the PS4 or the PS5, thanks to a different adapter it made for the 2016-era headset that connects it to the newer console.\r\n\r\nSony previously said it was testing \"the ability for PS VR2 players to access additional games on PC\" earlier this year and plans to roll out PC support sometime this year.\r\n\r\nIt\'s possible that Sony is opening up compatibility to better compete with its VR rivals like Meta, whose Meta Quest 3 and Meta Quest 2 headsets have long been able to connect to PCs to access PC VR apps and games. Sony\'s PS VR2 was first released back in February 2023.', 'it', '06-13-2024_10-07-54.jpg', 0),
(7, '13.06.2024.', '150,000 Tons of Water On Mars', 'Water frost found atop Mars\' Tharsis volcanoes could come in handy for future exploration missions.', 'Water frost has been spotted atop Mars\' gargantuan equatorial volcanoes for the first time — defying previous beliefs that the presence of water there was impossible.\r\n\r\nScientists spotted a hair-thin dusting of frost atop the peaks of the volcanoes in the Tharsis region of the Red Planet — the largest mountains in the solar system, which tower up to three times the height of Mount Everest. In colder months, the frost could consist of up to 150,000 tons of water, or the equivalent of 60 Olympic swimming pools. \r\n\r\n\"We thought it was improbable for frost to form around Mars\' equator, as the mix of sunshine and thin atmosphere keeps temperatures during the day relatively high at both the surface and mountaintop — unlike what we see on Earth, where you might expect to see frosty peaks,\" lead study author Adomas Valantinas, a postdoctoral fellow at Brown University, said in a statement. \r\n\r\nThe scientists discovered that the frost condenses along the summits of the mountains each night, before evaporating under the heat of the morning sun. The finding could be crucial for modeling water\'s existence on Mars that could aid in future human exploration missions. The researchers published their findings June 10 in the journal Nature Geoscience.\r\n\r\nRelated: In a 1st, NASA\'s Perseverance rover makes breathable oxygen on Mars\r\n\r\nThe frost was first spotted by the European Space Agency\'s Trace Gas Orbiter (TGO), which captured high-resolution color images during early morning . After analyzing 30,000 images snapped by the probe, the researchers confirmed the existence of the frost, an ethereal blue patina that forms in unique Martian microclimates from cool air wafting up to the peaks. \r\n\r\n\"What we\'re seeing may be a remnant of an ancient climate cycle on modern Mars, where you had precipitation and maybe even snowfall on these volcanoes in the past,\" Valantinas said.\r\n\r\nWith the existence of the frost confirmed, Valantinas will continue studying the Martian environment — particularly ancient hydrothermal pools that could have supported microbial life. One day, samples from these vents could be brought to Earth for study by NASA\'s proposed Sample Return Mission. \r\n\r\nSamples of Mars\' dust, and even evidence of ancient life, could have already been collected by the Perseverance rover, which has been exploring Jezero crater since 2021. NASA initially planned for a retrieval mission to launch sometime in 2026, but this date has since been delayed until 2040 due to budget concerns. NASA is currently soliciting proposals from private companies to speed up the mission timeline.\r\n\r\n\"This notion of a second genesis, of life beyond Earth, has always fascinated me,\" Valantinas said.', 'science', '06-13-2024_10-16-07.webp', 0),
(8, '13.06.2024.', 'Cataclysmic Asteroid Collision', 'The James Webb Space Telescope has caught a snapshot of two massive asteroids colliding.', 'The James Webb Space Telescope (JWST) has found evidence of two giant asteroids slamming into each other in a nearby star system. The colossal collision ejected 100,000 times more dust than the impact that killed the dinosaurs. \r\n\r\nThe violent impact occurred recently in Beta Pictoris, a star system located 63 light-years away in the constellation Pictoris. \r\n\r\nBeta Pictoris is a baby compared to our own solar system — having existed for only 20 million years compared with our system\'s venerable 4.5 billion years. It was first detected in 1983 by NASA\'s Infrared Astronomical Satellite (IRAS) spacecraft and is thought to have formed from the shockwave of a nearby supernova. \r\n\r\nWhile the young star system currently contains at least two gas giant planets it has no known rocky worlds like our own. But rocky inner planets may be in the process of forming, thanks to large dust-producing collisions like the one spotted by JWST, the researchers behind the new findings said in a June 10 presentation at the 244th Meeting of the American Astronomical Society in Madison, Wisconsin. \r\n\r\nBecause it is still very young, the star system\'s circumstellar debris disk — the vast ring of gas and dust surrounding the star — is a significantly more violent place than our own, making it the perfect place for astronomers to study the tumultuous early years of planet-forming systems. The team added that their findings could offer a rare insight into the history of our own solar system.\r\n\r\n\"Beta Pictoris is at an age when planet formation in the terrestrial planet zone is still ongoing through giant asteroid collisions, so what we could be seeing here is basically how rocky planets and other bodies are forming in real time,\" lead study author Christine Chen, an astronomer at Johns Hopkins University, said in a statement.\r\n\r\nTo capture a snapshot of the distant asteroid crash, the astronomers trained JWST\'s powerful eye on the system and found that giant masses of clumped silicate dust spotted by the Spitzer Space Telescope between 2004 and 2005 had completely disappeared. \r\n\r\nThis means that, sometime 20 years ago, a gigantic collision between two asteroids likely occurred, pounding the bodies into vast quantities of dust with particles smaller than pollen or powdered sugar, Chen said.\r\n\r\n\"With Webb\'s new data, the best explanation we have is that, in fact, we witnessed the aftermath of an infrequent, cataclysmic event between large asteroid-size bodies, marking a complete change in our understanding of this star system,\" Chen said.\r\n\r\nThe researchers suggest their findings will help astronomers to better understand how the architecture of star systems is constructed, and how often habitable systems like our own come into being. \r\n\r\n\"The question we are trying to contextualize is whether this whole process of terrestrial and giant planet formation is common or rare, and the even more basic question: Are planetary systems like the solar system that rare?\" study co-author Kadin Worthen, a doctoral student in astrophysics at Johns Hopkins University, said in the statement. \"We\'re basically trying to understand how weird or average we are.\"', 'science', '06-13-2024_10-18-52.webp', 0),
(9, '13.06.2024.', 'Mysterious \'Hole\' on Mars', 'Pit crater making recent headlines may open into a larger cave that could provide a shelter', 'A mysterious pit on the flank of an ancient volcano on Mars has generated excitement recently because of what it could reveal beneath the surface of the Red Planet. Here\'s what that means.\r\n\r\nFirst things first, the pit, which is only a few meters across, was actually imaged on Aug. 15, 2022 by NASA\'s Mars Reconnaissance Orbiter, which was about 159 miles (256 kilometers) above the Martian surface at the time. This hole in the ground is also not alone. It\'s one of many seen on the flanks of a trio of large volcanoes in the Tharsis region of Mars. This particular pit is found on a lava flow on the extinct volcano Arsia Mons, and appears to be a vertical shaft. That raises a question: Is it just a narrow pit, or does it lead to a much larger and remarkable cavern? Or, could it perhaps be a really deep lava tube formed underground long ago when the volcano was still active? \r\n\r\nThere are several reasons why pits and caves on Mars are of interest. For one, they could provide shelter for astronauts in the future; because Mars has a thin atmosphere and lacks a global magnetic field, it cannot ward off radiation from space the way that Earth does. Consequently, radiation exposure on the Martian surface averages between 40 and 50 times greater than on Earth. \r\n\r\nThe other enticing aspect of these pits is they might not just provide shelter for human astronauts; they could hold astrobiological interest in the sense that they could have been sheltered abodes for Martian life in the past — perhaps even today, if microbial life indeed exists there.\r\n\r\nThe presence of these so-called holes on the flanks of volcanoes is a big clue that they are probably connected to volcanic activity on Mars. Channels of lava can flow away from a volcano underground; when the volcano grows extinct, the channel empties. That leaves behind a long, underground tube. We see such tubes not only on Mars, but also on the moon and on Earth. \r\n\r\nSometimes, if the crust is thin enough, the ceiling of these tubes collapses. If a collapse happens along the tube\'s entire length, it forms a feature called a rille, which is a long trench commonly found on the moon and sometimes in other areas of Mars. If the tube\'s ceiling just collapses in small areas, however, we get pits like those imaged on Arsia Mons. Planetary scientists have also seen pit chains on the flanks of Martian volcanoes, which are linear stretches of multiple pits seemingly following the length of a lava tube.\r\n', 'science', '06-13-2024_10-25-44.webp', 0),
(10, '13.06.2024.', 'A \'new star\' could appear', 'The \"Blaze Star\" T Coronae Borealis will erupt with a magnificent explosion.', 'A dim star in the night sky 3,000 light-years from our solar system could soon become visible to the naked eye for the first time since 1946 — and you can easily find it in the night sky.\r\n\r\nThe \"Blaze Star\" — officially called T Coronae Borealis (T CrB) — is expected to brighten significantly between now and September 2024 from magnitude +10 (beyond naked-eye visibility) to magnitude +2, according to NASA. That\'s about the same brightness as Polaris, the North Star, the 48th-brightest star in the night sky. (In astronomy, the brighter an object is, the lower its magnitude; the full moon\'s magnitude is -12.6, for example).\r\n\r\nThe Blaze Star can be found in the constellation Corona Borealis, the \"Northern Crown,\" between the constellations of Boötes and Hercules. The easiest way of finding Corona Borealis is by first locating some of the brightest stars in the summer night sky. \r\n\r\nOn any clear night, find the stars of the Big Dipper high in the northern sky. Trace the Big Dipper\'s handle of stars in a curve to Arcturus, a bright, reddish star above the eastern horizon. That\'s the famous \"arc to Arcturus\" star-hop. Rising in the east-northeast will be Vega. Now look between Arcturus and Vega (slightly closer to Arcturus) for a faint curl of seven stars — Corona Borealis. It will be high overhead after dark. Though you won’t be able to see the Blaze Star yet, it should become clearly visible before summer’s end.\r\n\r\nThe Blaze Star is a rare example of a recurrent nova, which means \"new star\" in Latin. It\'s a binary star system with a cool, red giant star and a smaller, hotter white dwarf star orbiting each other. Every 80 years, the red giant propels matter onto the surface of the white dwarf, causing an explosion. Other stars do something similar, but not on such a short timescale. \r\n\r\nAstronomers think the Blaze Star is on the cusp of exploding again because it\'s following the same pattern as the last two explosions in 1866 and 1946. Ten years before both explosions, it got somewhat brighter, then finally dimmed again just before the big blast. That\'s precisely what\'s been happening, with the star growing brighter since 2015, followed by a visible dimming in March 2023. This familiar pattern suggests that another explosion is imminent. \r\n', 'science', '06-13-2024_10-28-06.jpg', 0),
(11, '13.06.2024.', 'Wendy’s new Frosty flavor', 'Wendy’s dropped a new Frosty flavor and it’s dividing customers.', 'The internet is totally divided on whether to truly love or deeply dislike Wendy’s newest icy treat.\r\n\r\nOn June 12, the chain announced its new limited-edition Frosty flavor: Triple Berry. Wendy’s called this nationwide offering “the biggest and juiciest flavor” to join its ever-growing frozen dessert lineup. \r\n\r\nThe chain says its berry-inspired Frosty combines three summer fruit flavors: strawberry, blackberry and raspberry.\r\n\r\n“A Frosty that’s just as bright in color as it is in berry flavor, Triple Berry Frosty is the sweet treat of the summer,” the company writes in a press release.\r\n\r\n“We’ve seen Frosty fandom continue to grow with each new flavor we roll out — and Triple Berry Frosty is sure to deliver,” Lindsay Radkoski, U.S. CMO for The Wendy’s Company, said in a press release. “Since 1969, Wendy’s has been famous for our Frosty and fans can trust that we’ll continue to evolve our iconic treat, inspired by our fans’ cravings and the flavors of the season.”\r\n\r\nThe chain says this new flavor profile combines sweet with tart, and John Li, the company’s global VP of culinary innovation, likened it to “walking through the farmers market in the middle of summer and sampling fresh berry preserves.”\r\n\r\nPleasant seasonal imagery aside, folks around the country have now been able to try the new flavor — and many of them have strong opinions.\r\n\r\n“This is definitely giving Triple Berry,” says TikToker @shayclick in her online review. “Oh my gosh, I should have got some fries to dip this in, what was I thinking?”\r\n\r\n“that Wendy’s new Triple Berry Frosty was so damn delicious yesterday,  i dreamed about it all night ?,” posted one X user. “i’m getting another one today. XL !!!! ?”\r\n\r\nWhile much of the feedback was obviously positive, there are also lots of critics.\r\n\r\n', 'food', '06-13-2024_10-31-03.webp', 0),
(12, '13.06.2024.', 'What’s in a Four Loko?', 'What’s in a Four Loko? A viral video about the adult beverage is causing confusion', 'A buzzy college-favorite drink is courting controversy once again.\r\n\r\nOn June 10, TikTok user @kylizzlec posted a short, 13-second clip that has since gone viral. In the video, which has more than 2.3 million views and more than 375,000 likes, the TikToker is shocked after discovering a nutritional fact about the Four Loko she’s been drinking.\r\n\r\n“pov: we just realized there’s 300 calories in a four loko serving and almost 5 servings per can,” reads an on-screen caption.\r\n\r\nThe video shows two women with their mouths agape in shock. One holds a can of FourLoko with a straw peeking out of it. “Wait, this can’t be right,” she says.\r\n\r\nThe TikToker’s video riled people up, becoming a point of interest for many TikTok commenters, with more than 3,000 people sharing their thoughts.\r\n\r\n“I get so scared with Alcohol calories?,” wrote one user on the platform.\r\n\r\n“Wait so it’s like 1,500 for one can????? ?? bruh I’m never drinking a four loko again,” wrote another commenter, with someone else asking, “Why do they not have to put the calories on the can like any other food or drink ?”\r\n\r\nFour Loko doesn’t list the nutrition facts on its website or packaging, but does list its Alcohol By Volume content. The lowest ABV the brand sells is 12.9% in flavors like its Strawberry Lemonade and Watermelon, and its highest ABV is 13.9% per 23.5 ounces in its Jungle Juice and Gold flavors.\r\n\r\nAccording to its website, Four Loko is “a premium malt beverage” — which means it contains malted barley. The brand also lists “natural and artificial flavors” as ingredients on its site.\r\n\r\nThe FDA first began requiring nutritional labeling on food and drink in 1990, after two decades of allowing companies to voluntarily apply them. Still, alcoholic beverages aren’t regulated by the FDA, but by a different federal agency called the Alcohol and Tobacco Tax and Trade Bureau, which doesn’t require nutritional labeling.\r\n\r\nThe TTB says it considers calorie, carbohydrate, protein and other nutritional statements to be misleading unless the products list the amounts based on a single serving.', 'food', '06-13-2024_10-33-31.avif', 0),
(13, '13.06.2024.', 'Restaurant only for over 30', 'This Missouri restaurant is only for people over the age of 30 and the internet has thoughts', 'A Midwest restaurant is igniting conversation over its strict age policy.\r\n\r\nOn May 26, Bliss Restaurant, a recently-opened Caribbean restaurant in Florissant, Missouri announced a policy for its patronage that has since gone viral around the internet. The eatery, which serves dishes like oxtail, jollof rice and fried plantain, revealed that it has age restrictions for entry: women must be 30 or over, and men must be 35 or older to dine.\r\n\r\n“As a Black-owned business, Bliss Caribbean Restaurant is dedicated to providing North County with an upscale dining experience,” Bliss Restaurant wrote on Facebook, adding that the restriction ensures a “grown and sexy atmosphere.” \r\n\r\nThe restaurant lists three reasons for the policy: that it creates a “mature and relaxed” atmosphere for its guests, that the restriction allows staff to focus on quality and that the policy “ensures our restaurant remains a premier destination for those seeking an upscale Caribbean dining experience.”\r\n\r\n“This policy helps us maintain a sophisticated environment, uphold our standards, and support the sustainability of our unique ambiance,” Bliss wrote.\r\n\r\nBliss later added in a June 7 post that its Friday happy hour is \"strictly for the grown and sexy, so we\'re keeping it classy—ladies 30 and up, fellas 35 and up.\"\r\n\r\nRepresentatives for Bliss Restaurant did not immediately respond to TODAY.com’s requests for comment.\r\n\r\nStill, assistant manager Erica Rhodes gave more insight into the eatery’s reasoning, speaking to local NBC affiliate KDSK.\r\n\r\n“It’s just something for the older people to come to and have a happy hour, come get some good food and not have to worry about so many young folks that bring some of that drama,” Rhodes said. \r\n\r\nOwner Marvin Pate also told the station, “Of course, we have been getting a little backlash, but that’s okay, because we sticking to our code.”\r\n\r\nKDSK also noted that patrons who enter the restaurant will have to show their ID to a hostess or St. Louis County Police officer after 7 p.m. Wednesdays through Sundays.\r\n\r\nThe Missouri hotspot’s age policy has spread around the internet, drawing conversation on TikTok as well as a post on the extremely popular Instagram account The Shade Room.  \r\n\r\nPate says that reaction to the policy has been mostly positive, with comments on social media seemingly backing that up on many different platforms.', 'food', '06-13-2024_10-36-45.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_croatian_ci NOT NULL,
  `href` varchar(64) COLLATE utf8_croatian_ci NOT NULL,
  `hidden` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `href`, `hidden`) VALUES
(1, 'Home', 'index.php', 0),
(2, 'Administration', 'administracija.php', 1),
(3, 'Login', 'login.php', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

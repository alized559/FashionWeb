-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2021 at 06:02 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `id16549915_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `recipeid` int(11) NOT NULL,
  `comment` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `userid`, `recipeid`, `comment`) VALUES
(2, 1, 2, 'A good to go appetizer if you are going for a quick bite, it is full of flavor and tastefully, try it out with a friend ;)'),
(5, 1, 3, 'One of my favorite desserts like no joke, i freaking love it! must try it out!'),
(9, 3, 1, 'This is a really good meal, i tried it out with my family and it was delicious, try it out with a family gathering!'),
(10, 3, 2, 'I cant say this is the best meal, if you are looking for a quick bite to work then yes, it is full of flavor try it out!'),
(11, 3, 2, 'On second thoughts, try it out, it might be good you never know, you cant take one persons opinion'),
(12, 3, 3, 'Okay so i tried this, it is really good. try it out, you might like the sweet tooth it will give you!'),
(13, 3, 4, 'A good to go appetizer if you are going for a quick bite, it is full of flavor and tastefully, try it out with a friend ;)');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `userid` int(11) NOT NULL,
  `recipeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`userid`, `recipeid`) VALUES
(1, 1),
(2, 1),
(1, 3),
(3, 3),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `ingredients` longtext NOT NULL DEFAULT '',
  `preparation` longtext NOT NULL DEFAULT '',
  `totallikes` int(11) NOT NULL DEFAULT 0,
  `totalcomments` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `type`, `time`, `ingredients`, `preparation`, `totallikes`, `totalcomments`) VALUES
(1, 'Prime Rib And Garlic Herbs', 'Main Dish', 45, '1 cup butter (230 g), softened\r\n7 cloves garlic, minced\r\n2 tablespoons fresh rosemary, finely chopped\r\n2 tablespoons fresh thyme, finely chopped\r\n2 tablespoons salt\r\n1 tablespoon pepper\r\n5 lb boneless rib eye roast (2.2 kg), trimmed\r\n2 tablespoons flour\r\n2 cups beef stock (475 mL)\r\nmashed potato, to serve\r\ngreen bean, to serve', 'Preheat oven to 500 °F (260 °C).\r\nMix together the butter, garlic, herbs, salt, and pepper in a bowl until evenly combined.\r\nRub the herb butter all over the rib roast, then place it on a roasting tray with a rack.\r\nBake for 5 minutes per pound (10 minutes per kilo) of meat, so a 5-pound (2.2 kg) roast would bake for 25 minutes.\r\nTurn off the heat and let the rib roast sit in the oven for 2 hours, making sure you do not open the oven door, or else the residual heat will escape.\r\nOnce the 2 hours are up, remove the roast from the pan and pour the pan drippings into a saucepan over medium heat.\r\nAdd the flour, whisking until there are no lumps, then add the beef stock, stirring and bringing the sauce to a boil.\r\nRemove from heat and strain the sauce into a gravy dish.\r\nCarve the prime rib into 20 mm slices.\r\nServe with the mashed potatoes, green beans, and sauce!\r\nEnjoy!', 2, 1),
(2, 'Honey Mustard Glazed Ham', 'Appetizer', 25, 'onion, chopped\r\n10 cloves garlic, peeled\r\n¼ cup apple cider vinegar (60 mL)\r\n¼ cup stone ground mustard (60 g)\r\n1 cup orange juice (240 mL)\r\n10 whole cloves\r\n10 lb picnic ham (4 ½ kg), cured\r\n½ cup honey (170 g)\r\n½ cup dijon mustard (125 g)\r\n1 cup brown sugar (220 g)\r\n', 'Preheat oven to 400 °F (200 °C).\r\nAdd the chopped onion, garlic cloves, apple cider vinegar, mustard, orange juice, and cloves to a large roasting pan, stirring to combine.\r\nPlace the ham on the roasting rack over the liquid.\r\nTrim off the tough outer skin, then score the remaining fat in a crosshatch pattern. Cover the entire roasting rack with aluminum foil and bake for 1 hour.\r\nRemove the ham from the oven, and remove the foil. Baste the ham with the liquid, then remove the rack from the roasting pan and set it aside.\r\nRemove all the whole cloves from the remaining liquid in the pan. Pour the remaining liquid into a pot, along with the honey, Dijon mustard, Worcestershire sauce, and brown sugar. Whisk to combine.\r\nBring the mixture to a boil over medium-high heat, then simmer until thick and reduced, about 10 minutes.\r\nBrush the glaze onto the ham then transfer back to the roasting rack.\r\nBake the ham for 30-45 minutes, or until the glaze is caramelized and the ham reaches 145 °F (65 °C).\r\nSlice the ham, and serve.\r\nEnjoy!', 1, 3),
(3, 'Caramel Macchiato Tiramisu', 'Dessert', 40, '2 tablespoons granulated sugar\r\n2 large pastured egg yolks, room temperature\r\n8 oz mascarpone cheese (225 g)\r\n2 tablespoons caramel sauce, prepared, plus more for drizzling\r\n9 ladyfingers, Italian\r\n½ cup espresso (120 mL), strong brewed, cooled\r\nwhipped cream, for serving flaky sea salt, for serving', 'Add the sugar and egg yolks in a small bowl and whisk vigorously until the mixture thickens and falls back on itself in a ribbon when the whisk is lifted, 6–8 minutes. Fold in the mascarpone and caramel sauce to combine evenly.\r\nBreak each ladyfinger in half crosswise. Dunk each half briefly in the espresso and arrange 3 halves, side by side, in the bottom of each of two cocktail glasses. (You may need to squish them tightly together to fit). Top each with 3 heaping tablespoons of the caramel-mascarpone mixture and smooth the tops with the back of the spoon. Continue layering the ladyfinger halves and the caramel-mascarpone mixture to make 3 layers. Discard any remaining espresso. Cover the glasses with plastic wrap and refrigerate for at least 2 hours, and up to 24 hours (the longer it sits, the better it gets).\r\nWhen ready to serve, uncover and top each glass with a dollop of whipped cream. Drizzle with more caramel sauce and sprinkle each with a pinch of flaky salt.\r\nEnjoy!', 3, 2),
(4, 'Low-Carb Eggplant Parmesan', 'Appetizer', 40, '1 large eggplant\r\n1 ½ cups almond meal (145 g)\r\n1 tablespoon Italian seasoning\r\n3 large eggs\r\nwater, splash\r\n1 cup rice flour (125 g)\r\nolive oil, to taste\r\n3 cloves garlic, minced\r\n½ teaspoon red pepper flakes\r\n28 oz crushed san Marzano tomato (895 g), 1 can\r\n6 large leaves fresh basil, chopped, plus more for garnish\r\n1 ½ cups shredded mozzarella cheese (150 g)\r\n¾ cup shredded parmesan cheese (85 g)', 'Preheat the oven to 375°F (190˚C).\r\nTrim the ends off the eggplant, then slice into ½-inch (2-cm) thick rounds. Transfer the rounds to a baking sheet lined with paper towels and sprinkle with salt on both sides. Let sit for 10 minutes for the salt to draw out excess moisture from the eggplant.\r\nIn a medium bowl, whisk together the almond meal, Italian seasoning, and a pinch of salt. Beat the eggs in another medium bowl with a splash of water. Add the rice flour to another medium bowl.\r\nCoat the salted eggplant rounds in the rice flour, then in the egg, letting any excess drip off, then in the seasoned almond meal. Set the rounds on a baking sheet lined with parchment paper. Lightly drizzle on both sides with olive oil.\r\nBake the eggplant, flipping halfway through for even browning, for 30 minutes, or until golden brown.\r\nWhile the eggplant is baking, make the sauce: Heat a drizzle of olive oil in a medium saucepan over medium-low heat. Add the garlic and red pepper flakes and cook for 3-4 minutes, until the garlic is fragrant. Reduce the heat if the garlic is browning too quickly. Add the crushed tomatoes and stir to combine. Cover and simmer for 15 minutes, stirring occasionally to prevent the bottom from scorching. Add the basil and stir to incorporate.\r\nTo assemble, spread a bit of sauce in the bottom of a 9x13-inch (23x33-cm) baking dish, then add a layer of baked eggplant. Top with more sauce and sprinkle with the mozzarella and Parmesan cheese. Repeat with the remaining ingredients, using another baking dish if needed to make another single layer of eggplant.\r\nBake for 10 minutes, then turn the broiler on high and cook for another 3 minutes, until the cheese is browned and bubbling.\r\nServe garnished with more basil.\r\nEnjoy!', 0, 1),
(5, 'One-pot Ham & Potato Soup', 'Appetizer', 25, '2 strips bacon, cut into 1-inch (2 cm) pieces\r\n1 cup onion (150 g), diced\r\n1 cup carrot (120 g), diced\r\n1 cup celery (225 g), diced\r\n3 tablespoons flour\r\n2 cups ham (300 g), cooked and cubed\r\n2 potatoes, cubed\r\n1 teaspoon fresh thyme\r\n1 teaspoon black pepper\r\n6 cups chicken broth (1.4 L)\r\n2 bay leaves\r\n2 cups heavy cream (480 mL)', 'In a 6-quart (5.7 liters) dutch oven, cook bacon over medium-high heat until fat is rendered out and the pieces begin to get crispy.\r\nAdd onion, carrot, and celery, and cook until just tender, about 3 minutes.\r\nReduce heat to medium and add flour, stirring constantly for 1-2 minutes to avoid lumps.\r\nAdd ham, potatoes, thyme, and black pepper. Stir to coat the meat and potatoes in the roux/vegetable mix.\r\nAdd the chicken broth and bay leaves.\r\nCover and bring to a boil. Then reduce heat to medium-low and cook covered for 25-30 minutes.\r\nRemove bay leaves and stir in cream. Return to a simmer and serve.\r\nEnjoy!', 0, 0),
(6, 'Sausage And Egg Tacos', 'Appetizer', 20, '3 cups potato (675 g), peeled, diced\r\n2 cups breakfast sausage (275 g), cooked\r\n1 green bell pepper, diced\r\n½ white onion, chopped\r\n2 cups spinach (80 g)\r\n12 eggs\r\n2 teaspoons garlic powder\r\nsalt, to taste\r\npepper, to taste\r\n1 cup milk (240 mL), or milk alternative\r\n1 cup shredded cheddar cheese (100 g)\r\nsalsa, to serve', 'Layer the potatoes on the bottom of a greased slow cooker.\r\nAdd the sausage, green bell peppers, onion, and spinach.\r\nIn a large bowl or measuring cup whisk together the eggs, garlic powder, salt, pepper, and milk.\r\nPour egg mixture over the potatoes, sausage, and vegetables. Top with cheddar cheese.\r\nCover and cook on low for 6-8 hours\r\nCarefully remove lid and serve filling on a tortilla and add salsa.\r\nEnjoy!', 0, 0),
(7, 'Fried Spicy Crab Beignets', 'Appetizer', 55, '6 oz fresh lump crab meat (180 g)\r\n¼ cup mayonnaise (60 g)\r\n2 tablespoons shallot, finely chopped\r\n1 tablespoon fresh chives, finely chopped\r\n1 serrano pepper, seeded and finely chopped\r\n2 teaspoons McCormick® Paprika\r\n½ teaspoon kosher salt\r\n1 lemon, zested\r\n4 cups vegetable oil (960 g), for frying\r\n2 large eggs\r\n1 cup amber lager-style beer (240 mL)\r\n1 cup all-purpose flour (125 g)\r\n¼ cup cornstarch (25 g)\r\n2 teaspoons baking powder\r\n½ teaspoon kosher salt\r\nlemon wedge, for serving', 'Make the crab mixture: In a medium bowl, combine the crabmeat, mayonnaise, shallot, chives, serrano, McCormick® Paprika, salt, and lemon zest. Fold gently to combine.\r\nMake the beignets: In a 9-inch Dutch oven fitted with a deep-fry thermometer, heat the vegetable oil over medium heat until the temperature reaches 375°F (190°C).\r\nIn a large bowl, whisk the eggs until frothy. Gradually add the beer and whisk until incorporated.\r\nIn a medium bowl, whisk together the flour, cornstarch, baking powder, and salt.\r\nAdd the dry ingredients to the beer mixture and fold with a rubber spatula until just combined. Add the crab mixture to the batter and gently fold to combine.\r\nWorking in batches of about 4 at a time, carefully drop heaping tablespoons of the beignet batter into the hot oil and fry, turning occasionally, until crisp and deep golden brown, about 4 minutes. Transfer to a paper towel–lined plate to drain. Repeat with the remaining beignets, letting the oil return to temperature between batches.\r\nServe the beignets hot with a squeeze of lemon juice.\r\nEnjoy!', 0, 0),
(8, 'Elegant Braised Lamb Shank', 'Main Dish', 90, '6 lb lamb shanks (2.7 kg), 1 pound (455 g) each\r\nkosher salt, to taste\r\nfreshly ground black pepper, to taste\r\n2 tablespoons canola oil\r\n2 medium carrots, minced, plus 1 pound (455 grams) oblique-cut\r\n1 medium white onion, minced\r\n2 stalks celery, minced\r\n20 cloves garlic, minced, plus 15 whole, divided\r\n2 tablespoons tomato paste\r\n1 cup red wine (240 mL)\r\n4 cups chicken stock (960 mL)\r\n1 orange, juiced\r\n1 lemon, juiced\r\n5 sprigs of fresh rosemary\r\n10 sprigs of fresh thyme\r\n3 bay leaves\r\n1 lb brussels sprouts (455 g), halved\r\n1 lb red pearl onion (455 g), peeled\r\nolive oil, for drizzling\r\n3 lb Yukon gold potato (1.3 kg), peeled, chopped, and boiled\r\nwhite pepper, to taste\r\n½ cup unsalted butter (115 g), 1 stick, cubed and chilled\r\n1 cup sour cream (230 g)\r\n½ cup heavy cream (120 mL)\r\n¼ cup fresh parsley (10 g), chopped\r\n1 lemon, zested\r\n½ tablespoon flaky sea salt\r\n2 cloves garlic, minced\r\n2 tablespoons fresh chives, chopped\r\n1 teaspoon horseradish\r\norange, zested', 'Preheat the oven to 400°F (200°C).\r\nSeason the lamb shanks all over with salt and pepper.\r\nHeat the canola oil in a large Dutch oven over medium-high heat.\r\nSear 2 lamb shanks at a time until a dark brown crust forms on one side, 3-5 minutes. Sear the other sides of the meat until evenly browned. Remove the shanks from the pan and set aside. Remove all but 2 tablespoons of fat from the pan.\r\nAdd the minced carrots, onion, celery, and minced garlic to the pot. Season with salt and pepper, and cook until the vegetables are deeply caramelized, 15-20 minutes.\r\nAdd the tomato paste and cook until it browns and is aromatic, 5 minutes.\r\nAdd the red wine and scrape the bottom of the pot to release the flavorful browned bits stuck to the bottom. Cook until the wine reduces by half and thickens slightly, 3 minutes.\r\nAdd the chicken stock, orange juice, lemon juice, rosemary, thyme, and bay leaves. Stir and bring to a boil.\r\nReturn the lamb shanks to the Dutch oven, cover, and place in the oven for 2 hours, turning the shanks halfway through, until the lamb is tender and the braising liquid has thickened.\r\nAbout halfway through the lamb cooking time, add the oblique-cut carrots, Brussels sprouts, red pearl onions, and whole garlic cloves to a baking sheet. Drizzle with olive oil and season with salt and pepper. Toss to combine. Roast in the oven for 1 hour, or until the vegetables are tender.\r\nRight after the potatoes finish boiling, drain and transfer to a large bowl. Season with plenty of salt and a bit of white pepper, and mash the potatoes until as smooth as possible.\r\nFold in the butter, sour cream, and heavy cream until smooth and light.\r\nMake the citrus gremolata: In a small bowl, combine the parsley, lemon zest, flaky salt, garlic, chives, horseradish, and orange zest.\r\nTo serve, scoop mashed potatoes onto a plate. Add roasted vegetables and a lamb shank. Top with the braising liquid and citrus gremolata.\r\nEnjoy!', 0, 0),
(9, 'Garlic Chicken And Veggie Pasta', 'Main Dish', 65, '4 tablespoons olive oil, divided\r\n1 lb chicken breast (455 g), diced\r\n2 carrots, sliced\r\n1 zucchini, sliced\r\n1 yellow squash, sliced\r\n4 cups fresh kale (270 g), chopped\r\n2 cloves garlic, minced\r\n3 cups whole grain whole wheat rotini pasta (600 g), cooked al dente according to package instructions\r\n2 teaspoons dried oregano, divided\r\n2 teaspoons salt, divided\r\n2 teaspoons pepper, divided', 'Heat a large skillet with 2 tablespoons of olive oil on medium-high heat.\r\nAdd in diced chicken breast, followed by 1 teaspoon salt, 1 teaspoon pepper, and 1 teaspoon oregano. Cook until no longer pink. Remove chicken from skillet and set aside.\r\nAdd carrots to the skillet and sauté for 2-3 minutes until tender.\r\nAdd in zucchini and yellow squash, and sauté for an additional minute until they become slightly translucent.\r\nAdd in the kale, followed by 2 tablespoons of olive oil, 1 teaspoon salt, and 1 teaspoon pepper. Sauté until kale begins to wilt.\r\nMove veggies aside with a spatula and add in garlic. Sauté for about 30 seconds and then combine with the veggies. (This works best if you add garlic to the center of the skillet where there is more heat.)\r\nAdd in the cooked rotini pasta and chicken, followed by 1 teaspoon oregano, and mix until evenly incorporated. Remove skillet from heat.\r\nIf using plastic Tupperware for your weekday meal prep, allow the pasta to cool for about 10 minutes before filling the containers. Refrigerate up to 4 days.\r\nOr serve immediately for a family dinner.\r\nEnjoy!', 0, 0),
(10, 'Caprese Mac N Cheese', 'Main Dish', 45, '1 lb elbow macaroni (455 g), uncooked\r\n¼ cup unsalted butter (55 g), 1/2 stick\r\n¼ cup all-purpose flour (30 g)\r\n3 ½ cups whole milk (840 mL)\r\n¼ teaspoon paprika\r\n1 teaspoon ground black pepper, plus more to taste\r\n1 teaspoon kosher salt, plus more to taste\r\n2 cups baby spinach (80 g)\r\n2 cups shredded mozzarella cheese (200 g), divided\r\n½ lb fresh mozzarella cheese (225 g), sliced, optional\r\n3 small tomatoes, sliced\r\n3 tablespoons fresh basil, chopped', 'Preheat the oven to 350°F (180°C).\r\nBring a large pot of salted water to a boil and cook the pasta according to the package instructions. Drain and transfer to a large bowl. Set aside.\r\nIn a large cast-iron skillet, melt the butter over low heat until foamy. Add the flour and stir until completely smooth and slightly thickened, about 2 minutes.\r\nWhile stirring, gradually add the milk and cook until the sauce is thickened about 4 minutes. Season with paprika, pepper, and salt.\r\nFold in the spinach and stir until wilted. Add 1½ cups (150 g) of shredded mozzarella and stir until completely melted.\r\nAdd the cooked pasta and stir to coat in the sauce.\r\nSprinkle the remaining shredded mozzarella evenly over the pasta, then top with the fresh mozzarella if using. Arrange the tomato slices on top.\r\nBake until browned and bubbling, about 25 minutes.\r\nTop with basil before serving.\r\nEnjoy!', 0, 0),
(11, 'Lemon Chicken And Asparagus', 'Main Dish', 30, '½ tablespoon olive oil\r\n2 chicken breasts, sliced\r\n1 teaspoon salt\r\n½ teaspoon pepper\r\n1 tablespoon garlic, minced\r\n4 oz asparagus (100 g)\r\n½ lemon, zested\r\n½ lemon, juiced\r\n3 tablespoons soy sauce\r\nlemon, zested, to garnish\r\nrice, to serve', 'Season the chicken with the salt and pepper and fry with the olive oil. After a few minutes, add the garlic.\r\nFry the chicken with the garlic for another few minutes, then add the asparagus, lemon zest, and lemon juice.\r\nStir again, before mixing in the soy sauce.\r\nServe with rice and sprinkle with lemon zest on top.\r\nEnjoy!', 0, 0),
(12, 'Garlic Herb Crusted Roast Rack Of Lamb', 'Main Dish', 80, '2 ½ lb rack of lamb (1.1 kg), frenched\r\nsalt, to taste\r\npepper, to taste\r\n5 tablespoons olive oil, divided\r\n8 cloves garlic, peeled and smashed\r\n¾ cup breadcrumb (85 g)\r\n¼ cup fresh flat-leaf parsley (10 g)\r\n1 ½ tablespoons fresh rosemary\r\n½ cup grated parmesan cheese (55 g)\r\n1 ½ tablespoons whole grain dijon mustard', 'Preheat oven to 400°F (200°C).\r\nSeason lamb generously with salt and pepper.\r\nHeat a cast-iron over medium-high heat.\r\nTo the hot pan, add in 4 tablespoons of olive oil, along with the lamb and garlic. Sear all sides of the lamb until browned, about 3-4 minutes. Remove browned lamb, and place cooked lamb onto a baking sheet.\r\nRemove garlic and add to a food processor along with the breadcrumbs, parsley, parmesan, rosemary, and 1 tablespoon of olive oil. Pulse until combined. Pour onto a large plate.\r\nBrush the top and sides of the lamb with mustard.\r\nCoat the top and sides of the lamb with the breadcrumb mixture and roast in the oven for 20-25 minutes.\r\nAllow resting before slicing.\r\nEnjoy!', 0, 0),
(13, 'Sausage And Veggie Quiche', 'Main Dish', 40, '½ lb chicken sausage (225 g)\r\n½ cup onion (75 g), chopped\r\n½ cup mushroom (35 g), chopped\r\n4 oz fresh spinach (110 g), chopped\r\n½ teaspoon salt\r\n½ teaspoon black pepper\r\n6 eggs\r\n1 cup milk (240 mL)\r\n1 premade pie crust, thawed\r\nparmesan cheese, grated', 'Cook sausage over medium-high until lightly browned, about 5-7 minutes, being sure to break up the meat into a fine mince.\r\nRemove cooked sausage from pan and wipe away excess fat with a paper towel.\r\nAdd onion and sauté until softened and translucent, about 2 to 3 minutes. Add mushrooms, salt, and pepper and continue to cook for an additional 2-3 minutes.\r\nAdd chopped spinach and cook until wilted and no extra liquid has accumulated in the bottom of the pan.\r\nNOTE: Do your best to use the excessive moisture of the spinach and mushrooms to deglaze the bottom of the pan, scraping away any browned bits from cooking the sausage earlier.\r\nPreheat oven to 350˚F (180˚C).\r\nOnce cooked, remove the spinach and mushroom mixture from the pan and combine it with the reserved cooked sausage. Stir to mix evenly.\r\nCombine eggs and milk. Lightly whisk until just combined.\r\nAdd sausage and spinach mixture to the bottom of a prepared 9-inch (23cm) pie crust, making sure to spread it evenly.\r\nPour in beaten eggs to fill the rest of the pie crust and top with a generous sprinkle of parmesan cheese.\r\nBake at 350˚F (180˚C) for 25 minutes or until the eggs are set and the top is lightly browned. Allow to cool for 10 minutes before slicing and serving.\r\nEnjoy!', 0, 0),
(14, 'Steak With Charred Chimichurri', 'Main Dish', 65, '1 ½ lb skirt steak (680 g), trimmed of excess fat and cut into 3 pieces\r\n1 tablespoon vegetable oil\r\nkosher salt, to taste\r\nfreshly ground black pepper, to taste\r\n8 cloves garlic\r\n2 small shallots, halved lengthwise\r\n1 jalapeño, stemmed, halved, seeds and ribs removed\r\n1 cup fresh flat-leaf parsley leaves (40 g)\r\n¾ cup fresh cilantro (30 g)\r\n½ cup olive oil (120 mL)\r\n¼ cup fresh oregano leaf (10 g), packed\r\n¼ cup red wine vinegar (60 mL)', 'Heat a large cast-iron skillet over high heat until it begins to smoke.\r\nBrush the steaks with the vegetable oil and season liberally with salt and pepper.\r\nPlace the steak in the skillet, working in batches as needed. Cook, flipping once halfway through, until charred on the outside and medium-rare inside, 4–8 minutes, depending on the thickness of the steak. If working in batches, wipe out the skillet between batches.\r\nTransfer the steaks to a cutting board and let rest for 10 minutes.\r\nReduce the heat to medium-high. Add the garlic, shallots, and jalapeño and cook, turning as needed, until blackened in spots and softened, about 8 minutes.\r\nTransfer the vegetables to a food processor or blender. Add the parsley, cilantro, olive oil, oregano, and vinegar and purée until smooth. Season the chimichurri with salt and pepper. You should have about 1 cup.\r\nTo serve, cut the steaks against the grain into ¼-inch thick slices. Transfer to a serving platter or plates and spoon the charred chimichurri over the top.\r\nEnjoy!', 0, 0),
(15, 'Classic And Tasty Carrot Cake', 'Dessert', 115, '3 cups carrot (450 g), hand-grated\r\n2 ½ cups all-purpose flour (310 g), plus 1 tablespoon, divided\r\n2 teaspoons ground cinnamon\r\n¼ teaspoon allspice\r\n1 teaspoon kosher salt\r\n1 teaspoon baking powder\r\n½ teaspoon baking soda\r\n1 cup light brown sugar (200 g), packed\r\n½ cup granulated sugar (100 g)\r\n3 large eggs, room temperature\r\n1 cup vegetable oil (240 mL)\r\n1 cup raisin (150 g)\r\n1 cup crushed pineapple (225 g), canned\r\n1 cup unsalted butter (225 g), (2 sticks) room temperature\r\n12 oz cream cheese (340 g), room temperature\r\n1 ½ teaspoons vanilla extract\r\n2 cups powdered sugar (240 g)\r\n2 cups walnuts (200 g), crushed', 'Preheat the oven to 350˚F (180˚C). Grease 3 8-inch (20 cm) round cake pans and line with parchment paper.\r\nGrate the carrots on the small holes of a box grater. Set aside.\r\nIn a large bowl, sift together 2½ cups (310 G) of flour, cinnamon, allspice, salt, baking powder, and baking soda. Whisk together.\r\nIn a separate large bowl, beat the brown sugar, granulated sugar, and eggs together with an electric hand mixer on medium speed until just combined.\r\nWith the mixer running, gradually pour in the vegetable oil.\r\nWith the mixer on medium-low speed, add ⅓ of the flour mixture at a time to the wet ingredients. Beat just to incorporate. Stop mixing when there is just a small amount of flour visible.\r\nIn a small bowl, toss the raisins with the remaining tablespoon of flour.\r\nAdd the raisin, grated carrots, and pineapple to the batter and fold to incorporate with a rubber spatula.\r\nDivide the cake batter evenly between the prepared pans and smooth the tops.\r\nBake for 25-30 minutes, until a fork inserted in the center of a cake comes out clean.\r\nCool the cakes on a wire rack until the pans are cool to the touch. Remove the cakes from the pans and let cool completely on the rack.\r\nMake the icing: In a large bowl, beat together the butter, cream cheese, and vanilla with an electric hand mixer on medium-low speed. Once combined, mix on medium-high speed for 30 seconds, until light and fluffy.\r\nAdd the powdered sugar, ½ cup (60 G) at a time, beating on medium-low speed to incorporate each addition.\r\nAssemble the cake: Check to see if the top of each cake is flat. If not, use a serrated knife level off the cakes.\r\nPlace 1 cake layer on a serving platter or cake stand. Spoon ¼ of the icing on top and spread in an even layer. Add another layer of cake and spread with another ¼ of the icing. Set the last cake layer on top with the bottom up to ensure a very flat surface. Spread the rest of the icing over the top and sides.\r\nGently press the walnuts into the icing around the sides of the cake.\r\nChill for 30-60 minutes to let the icing set, then slice and serve.', 0, 0),
(16, 'Egg Shaped Sugar Cookies', 'Dessert', 60, '2 ½ cups all-purpose flour (310 g), plus more for rolling\r\n1 teaspoon baking soda\r\n1 teaspoon cream of tartar\r\n½ teaspoon fine sea salt\r\n1 cup unsalted butter (230 g), 2 sticks, at room temperature\r\n1 ½ cups powdered sugar (240 g)\r\n1 large egg\r\n½ lemon, zested\r\n2 teaspoons pure vanilla extract\r\n4 large pasteurized egg whites\r\n4 cups powdered sugar (640 g), sifted\r\n1 teaspoon fresh lemon juice\r\nfood coloring, of choice', 'Make the cookies: in a medium bowl, whisk together the flour, baking soda, cream of tartar, and salt.\r\nIn another large bowl, beat the butter and sugar with a hand mixer on medium-high until light in color and fluffy in texture, 3-5 minutes.\r\nAdd the egg and mix until incorporated.\r\nMix in the lemon zest and vanilla, then add the flour mixture and mix with a spatula until just combined.\r\nTransfer the cookie dough to a clean work surface and divide into two balls. Flatten each into a 5-inch (12-cm) disc, wrap in plastic wrap, and refrigerate for at least 2 hours, up to 3 days.\r\nPreheat the oven to 350°F (180°C). Line two baking sheets with parchment paper.\r\nOn a lightly floured surface, roll out one of the dough discs into a ¼-inch (6 mm) thick circle.\r\nUse egg-shaped cookie cutters to cut out shapes and transfer to the prepared baking sheets.\r\nBake until the cookies are golden around the edges, 6-8 minutes depending on the size.\r\nCool for 1 minute on the baking sheets, then transfer to a wire rack to cool completely before decorating. Repeat with the other dough disc.\r\nMake the icing: in a large bowl, beat the egg whites on high speed with a hand mixer until foamy. Reduce the speed to low and gradually add the sugar, beating until completely incorporated. Add the lemon juice and return the speed to high, beating until the icing is very stiff, 5-7 minutes.\r\nDivide the icing between four bowls and color three with food coloring of choice.\r\nTransfer the icings to piping bags or plastic bags fitted with round tips and decorate the cooled cookies.\r\nEnjoy!', 0, 0),
(17, 'Creme Egg Bundt Cake', 'Dessert', 35, '2 cups self-raising flour (250 g)\r\n1 ½ cups caster sugar (300 g)\r\n1 ¼ cups cocoa powder (150 g)\r\n1 ⅓ cups butter (300 g)\r\n5 eggs\r\n1 ½ teaspoons baking powder\r\n1 teaspoon vanilla extract\r\n1 ⅛ cups milk chocolate (200 g)\r\n9 creme eggs', 'Add the flour, caster sugar, cocoa powder, butter, eggs, baking powder and vanilla extract to a large bowl and whisk until smooth and thoroughly mixed.\r\nTransfer mixture to the bundt cake tin, smooth out then place 6 creme eggs upright around the circle. Make sure they don’t touch the bottom but are sunken in.\r\nCover the creme eggs with the cake mix, then bake for 35 minutes at 180°C (350°F). Cool for 20 minutes.\r\nRemove cake from tin carefully, then pour melted chocolate over the top, covering completely.\r\nCut 3-4 creme eggs in half and decorate over the top - the messier the better!\r\nEnjoy!', 0, 0),
(18, 'Bunny Ear Sweet Buns', 'Dessert', 180, '1 lb strawberry (455 g), stemmed and quartered\r\n¼ cup granulated sugar (50 g)\r\n¼ teaspoon kosher salt\r\n¼ teaspoon ground cardamom\r\n¼ teaspoon ground cinnamon\r\n2 teaspoons fresh lemon juice\r\n½ teaspoon vanilla extract\r\n1 cup powdered sugar (110 g)\r\n¼ teaspoon ground cinnamon\r\n¼ teaspoon ground cardamom\r\n1 tablespoon whole milk, plus more as needed\r\n2 ⅔ cups bread flour (465 g), plus more for dusting\r\n¾ cup dried cranberries (95 g)\r\n⅓ cup granulated sugar (65 g)\r\n1 packet instant yeast\r\n1 ½ teaspoon kosher salt\r\n1 stick unsalted butter\r\n⅓ cup whole milk (80 g)\r\n1 vanilla bean, seeds scraped\r\n4 large eggs, divided\r\nnonstick cooking spray, for greasing', 'Make the roasted strawberries: Preheat the oven to 375°F (190°C).\r\nIn a glass 9 x 13-inch (22 x 33 cm) baking dish, toss together the strawberries, sugar, salt, cardamom, cinnamon, and lemon juice.\r\nRoast until the strawberries are tender, but not mushy, about 30 minutes. Remove from the oven and stir in the vanilla. Let cool completely. Strain the strawberries from the syrup before using.\r\nMake the icing: In a small bowl, stir together the powdered sugar, cinnamon, cardamom, and milk until a thick paste forms, adding another splash of milk if needed. Transfer to a small piping bag or zip-top bag. Snip the tip just before piping.\r\nMake the bunny ear buns: In a large bowl, stir together the flour, cranberries, sugar, yeast, and salt.\r\nIn a small saucepan, combine the butter and milk. Warm over medium-low heat until the butter melts completely. Stir in the vanilla bean seeds.\r\nPour the warm butter mixture into the dry ingredients. Add 3 eggs and stir with a wooden spoon until a shaggy dough forms.\r\nTurn the dough out onto a lightly floured surface and knead until smooth and elastic, about 10 minutes. Transfer to a clean large bowl lightly greased with nonstick spray, cover, and let rest until doubled in size, about 90 minutes.\r\nPreheat the oven to 350°F (180°C). Line 2 baking sheets with parchment paper.\r\nTurn the dough out onto a clean surface and divide into 12 equal pieces. Take 2 pieces of dough and roll each into a log, about 8 inches long. Place the logs on a prepared baking sheet and connect one end of each in a “V” shape. Repeat with 6 more pieces of dough, to create 4 “V” shapes, 2 per baking sheet.\r\nFlatten each of the remaining 4 pieces of dough into a small oval, about 4 inches in diameter. Place each oval over the connected ends of each “V”. Cover the dough bunnies with clean kitchen towels and let rest for about 15 minutes.\r\nBeat the remaining egg in a small bowl, then brush all over the bunnies. Reserve the leftover egg. Let the dough rest, rising 1 ½ times its original size, for another 15 minutes.\r\nBrush the bunnies all over with egg wash again. Using your fingers, press firmly to create indentations down the center of each log; these will be the inside of the bunny ears. Spoon enough roasted strawberries into each ear cavity to fill completely, about 2 tablespoons each.\r\nBake until the bread is shiny and golden brown, about 20 minutes. Remove from the oven and let cool completely about 30 minutes.\r\nOnce cool, squeeze the icing around the strawberry filling to outline the ears.\r\nEnjoy!', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` text NOT NULL,
  `joindate` date NOT NULL DEFAULT current_timestamp(),
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `joindate`, `admin`) VALUES
(1, 'user1', 'user1@email.com', 'test123', '2021-05-17', 0),
(2, 'admin', 'admin@email.com', 'admin123', '2021-05-17', 1),
(3, 'user2', 'user2@email.com', 'user2pass', '2021-05-17', 0),
(8, 'Hello1', 'idk@gmail.com', 'okay123', '2021-05-20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

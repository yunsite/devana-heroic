<?php
//resources
$gl['resources']=array(
 0=>array('name'=>'金', 'description'=>'金矿通过开采金矿得到'),
 1=>array('name'=>'木', 'description'=>'木材通过开伐树木得到。'),
 2=>array('name'=>'铁', 'description'=>'铁通过开采铁矿得到。'),
 3=>array('name'=>'开发度', 'description'=>'开发度代表了经济的进展。'),
 4=>array('name'=>'仓库', 'description'=>'存储物件使用。'),
 5=>array('name'=>'食物', 'description'=>'你的人口消耗食物。')
);
//factions
$gl['factions']=array(
 0=>array('name'=>'中央公国', 'description'=>'经济和军事均平衡发展的政体。'),
 1=>array('name'=>'精灵工会', 'description'=>'着重于发展经济的政体。'),
 2=>array('name'=>'钢铁军团', 'description'=>'着重于发展军事的政体。')
);
//technologies per faction
$gl['technologies']=array(
 0=>array(
  0=>array('name'=>'锻造术', 'description'=>'允许打造铁制装甲和武器。'),
  1=>array('name'=>'战斗训练', 'description'=>'允许训练基本的军事单位。'),
  2=>array('name'=>'高级战术训练', 'description'=>'允许训练高级的军事单位。'),
  3=>array('name'=>'驯马术', 'description'=>'允许训练骑兵单位。'),
  4=>array('name'=>'造币', 'description'=>'允许交换资源。')
 ),
 1=>array(
  0=>array('name'=>'太阳精灵加护', 'description'=>'允许打造铁制装甲和武器。'),
  1=>array('name'=>'月光精灵加护', 'description'=>'允许训练基本的军事单位。'),
  2=>array('name'=>'战神加护', 'description'=>'允许训练高级的军事单位。'),
  3=>array('name'=>'自然交换', 'description'=>'允许训练骑兵单位。'),
  4=>array('name'=>'高级感应术', 'description'=>'允许交换资源。')
 ),
 2=>array(
  0=>array('name'=>'锻造工艺', 'description'=>'允许打造铁制装甲和武器。'),
  1=>array('name'=>'爱国主义', 'description'=>'允许训练基本的军事单位。'),
  2=>array('name'=>'征兵', 'description'=>'允许训练高级的军事单位。'),
  3=>array('name'=>'驯马术', 'description'=>'允许训练骑兵单位。'),
  4=>array('name'=>'造币', 'description'=>'允许交换资源。')
//  0=>array('name'=>'Metallurgy', 'description'=>'Allows the use of iron in armor and weapons.'),
//  1=>array('name'=>'Military training', 'description'=>'Allows the training of basic military units.'),
//  2=>array('name'=>'Advanced military training', 'description'=>'Allows the training of advanced military units.'),
//  3=>array('name'=>'Horse breeding', 'description'=>'Allows the training of mounted units.'),
//  4=>array('name'=>'Currency', 'description'=>'Allows the exchange of resources.')
 )
);
//modules per faction
$gl['modules']=array(
 0=>array(
  0=>array('name'=>'金矿', 'description'=>'金矿产生资源『金』。'),
  1=>array('name'=>'伐木场', 'description'=>'伐木场产生资源『木』。'),
  2=>array('name'=>'铁矿', 'description'=>'铁矿产生资源『铁』。'),
  3=>array('name'=>'防具工房', 'description'=>'在这里可以炼造防具。'),
  4=>array('name'=>'武器工房', 'description'=>'在这里可以炼造武器。'),
  5=>array('name'=>'兵营', 'description'=>'在这里可以训练步兵单位。'),
  6=>array('name'=>'马厩', 'description'=>'在这里可以训练骑兵单位。'),
  7=>array('name'=>'酒馆', 'description'=>'在这里雇佣高级单位'),
  8=>array('name'=>'实验室', 'description'=>'在这里研究新技能。'),
  9=>array('name'=>'市场', 'description'=>'交易资源和物品。'),
  10=>array('name'=>'金库', 'description'=>'存放多余的金资源。'),
  11=>array('name'=>'木材库', 'description'=>'存放多余的木材资源。'),
  12=>array('name'=>'铁仓库', 'description'=>'存放多余的铁资源。'),
  13=>array('name'=>'房屋', 'description'=>'增加开发度。')
 ),
 1=>array(
  0=>array('name'=>'金魔法阵', 'description'=>'金魔法阵产生资源『金』。'),
  1=>array('name'=>'木魔法阵', 'description'=>'木魔法阵产生资源『木』。'),
  2=>array('name'=>'铁魔法阵', 'description'=>'铁魔法阵产生资源『铁』。'),
  3=>array('name'=>'防具工房', 'description'=>'在这里可以炼造防具。'),
  4=>array('name'=>'武器工房', 'description'=>'在这里可以炼造武器。'),
  5=>array('name'=>'兵营', 'description'=>'在这里可以训练步兵单位。'),
  6=>array('name'=>'马厩', 'description'=>'在这里可以训练骑兵单位。'),
  7=>array('name'=>'祭坛', 'description'=>'在这里召唤高级单位'),
  8=>array('name'=>'教会', 'description'=>'在这里研究新技能。'),
  9=>array('name'=>'市场', 'description'=>'交易资源和物品。'),
  10=>array('name'=>'金库', 'description'=>'存放多余的金资源。'),
  11=>array('name'=>'木材库', 'description'=>'存放多余的木材资源。'),
  12=>array('name'=>'铁仓库', 'description'=>'存放多余的铁资源。'),
  13=>array('name'=>'房屋', 'description'=>'增加开发度。')
 ),
 2=>array(
  0=>array('name'=>'金矿', 'description'=>'金矿产生资源『金』。'),
  1=>array('name'=>'伐木场', 'description'=>'伐木场产生资源『木』。'),
  2=>array('name'=>'铁矿', 'description'=>'铁矿产生资源『铁』。'),
  3=>array('name'=>'防具工房', 'description'=>'在这里可以炼造防具。'),
  4=>array('name'=>'武器工房', 'description'=>'在这里可以炼造武器。'),
  5=>array('name'=>'兵营', 'description'=>'在这里可以训练步兵单位。'),
  6=>array('name'=>'马厩', 'description'=>'在这里可以训练骑兵单位。'),
  7=>array('name'=>'雇佣局', 'description'=>'在这里雇佣高级单位'),
  8=>array('name'=>'战地学校', 'description'=>'在这里研究新技能。'),
  9=>array('name'=>'市场', 'description'=>'交易资源和物品。'),
  10=>array('name'=>'金库', 'description'=>'存放多余的金资源。'),
  11=>array('name'=>'木材库', 'description'=>'存放多余的木材资源。'),
  12=>array('name'=>'铁仓库', 'description'=>'存放多余的铁资源。'),
  13=>array('name'=>'房屋', 'description'=>'增加开发度。')
//  0=>array('name'=>'Gold mine', 'description'=>'Gold mines produce gold.'),
//  1=>array('name'=>'Lumber mill', 'description'=>'Lumber mills harvest lumber.'),
//  2=>array('name'=>'Iron mine', 'description'=>'Iron mines produce iron.'),
//  3=>array('name'=>'Armor shop', 'description'=>'Armor is forged here.'),
//  4=>array('name'=>'Weapon shop', 'description'=>'Weapons are forged here.'),
//  5=>array('name'=>'Barracks', 'description'=>'Infantry units are trained here.'),
//  6=>array('name'=>'Stables', 'description'=>'Mounted units are trained here.'),
//  7=>array('name'=>'Mercenary hut', 'description'=>'Hire units for gold.'),
//  8=>array('name'=>'Laboratory', 'description'=>'New technologies are researched here.'),
//  9=>array('name'=>'Marketplace', 'description'=>'Trade components and resources.'),
//  10=>array('name'=>'Gold Storage', 'description'=>'Stores extra gold.'),
//  11=>array('name'=>'Lumber Storage', 'description'=>'Stores extra lumber.'),
//  12=>array('name'=>'Iron Storage', 'description'=>'Stores extra iron.')
 )
);
//components per faction
$gl['components']=array(
 0=>array(
  0=>array('name'=>'布甲', 'description'=>'差不多的防御护甲。'),
  1=>array('name'=>'板甲', 'description'=>'强力的防御护甲。'),
  2=>array('name'=>'盾牌', 'description'=>'提供附加的防御。'),
  3=>array('name'=>'短剑', 'description'=>'差不多的近战武器。'),
  4=>array('name'=>'长剑', 'description'=>'强力的近战武器。'),
  5=>array('name'=>'弓', 'description'=>'训练『弓箭手』需要。'),
  6=>array('name'=>'长弓', 'description'=>'训练『长弓手』需要。'),
  7=>array('name'=>'枪', 'description'=>'高级的近战武器。')
 ),
 1=>array(
  0=>array('name'=>'布衣', 'description'=>'普通的防御护甲。'),
  1=>array('name'=>'道服', 'description'=>'强力的防御护甲。'),
  2=>array('name'=>'盾牌', 'description'=>'提供附加的防御。'),
  3=>array('name'=>'匕首', 'description'=>'普通的近战武器。'),
  4=>array('name'=>'刺剑', 'description'=>'强力的近战武器。'),
  5=>array('name'=>'法杖', 'description'=>'训练『主教人形』需要。'),
  6=>array('name'=>'法书', 'description'=>'训练『魔导人形』需要。'),
  7=>array('name'=>'水晶刃', 'description'=>'高级的近战武器。')
 ),
 2=>array(
  0=>array('name'=>'布甲', 'description'=>'差不多的防御护甲。'),
  1=>array('name'=>'板甲', 'description'=>'强力的防御护甲。'),
  2=>array('name'=>'盾牌', 'description'=>'提供附加的防御。'),
  3=>array('name'=>'短剑', 'description'=>'差不多的近战武器。'),
  4=>array('name'=>'长剑', 'description'=>'强力的近战武器。'),
  5=>array('name'=>'弓', 'description'=>'训练『弓箭手』需要。'),
  6=>array('name'=>'长弓', 'description'=>'训练『长弓手』需要。'),
  7=>array('name'=>'枪', 'description'=>'高级的近战武器。')
//  0=>array('name'=>'Cloth armor', 'description'=>'Medium defense armor.'),
//  1=>array('name'=>'Plate armor', 'description'=>'High defense armor.'),
//  2=>array('name'=>'Shield', 'description'=>'Provides aditional defense.'),
//  3=>array('name'=>'Short sword', 'description'=>'Medium damage melee weapon.'),
//  4=>array('name'=>'Long sword', 'description'=>'High damage melee weapon.'),
//  5=>array('name'=>'Bow', 'description'=>'Required by archers.'),
//  6=>array('name'=>'Longbow', 'description'=>'Required by longbow-men.'),
//  7=>array('name'=>'Spear', 'description'=>'High damage melee weapon.')
 )
);
//unit classes
$gl['classes']=array(
 'spearman'=>'步兵系',
 'swordsman'=>'剑士系',
 'duelist'=>'斗士系',
 'archer'=>'弓兵系',
 'cavalry'=>'骑兵系',
 'static'=>'静止单位'
);
//units per faction
$gl['units']=array(
 0=>array(
  0=>array('name'=>'民兵', 'description'=>'被穿上盔甲征召的平民，使用枪作为武器，战斗力普通。'),
  1=>array('name'=>'戟兵', 'description'=>'接受过训练等待部署的长枪兵，拥有优于前者的武器和护甲。'),
  2=>array('name'=>'游侠', 'description'=>'挥舞着双手剑的战士，牺牲了护甲换取灵活度。'),
  3=>array('name'=>'剑士', 'description'=>'武装着大剑和盾牌的剑士是军队的必要部分。'),
  4=>array('name'=>'精英战士', 'description'=>'接受高级训练使用着剑和盾牌的精英部队。'),
  5=>array('name'=>'弓箭手', 'description'=>'弓箭手远程攻击强劲，但是碰上强力兵种的时候贫弱的护甲就会变成软肋。'),
  6=>array('name'=>'长弓手', 'description'=>'长弓造成更高的伤害，并且他们换上了板甲，解决了护甲的问题。'),
  7=>array('name'=>'枪兵骑士', 'description'=>'骑在马上的枪兵。'),
  8=>array('name'=>'大剑骑士', 'description'=>'骑在马上的大剑兵。'),
  9=>array('name'=>'精英骑士', 'description'=>'受过训练的高级游侠骑士。'),
  10=>array('name'=>'间谍', 'description'=>'隐秘和欺骗的行家，间谍可以在敌人的后方造成巨大的破坏。'),
  11=>array('name'=>'动员兵', 'description'=>'也只能够和熊之类的东西玩玩了。'),
  12=>array('name'=>'佣兵', 'description'=>'比动员兵战斗力强，不过也就是这种程度。'),
  13=>array('name'=>'浪人', 'description'=>'走了千里路的自称战士。'),
  14=>array('name'=>'雇佣弓兵', 'description'=>'拿着弓箭的动员兵，至少能射下苹果'),
  15=>array('name'=>'游侠', 'description'=>'云游四方而行侠仗义是为游侠也。'),
  16=>array('name'=>'盗贼', 'description'=>'有价值的地方都会有他们的身影。'),
  17=>array('name'=>'防卫塔', 'description'=>'对英雄的伤害会随着攻击次数上升。'),
  18=>array('name'=>'城墙', 'description'=>'吃下吧，这是8000点LP的反弹伤害！')
 ),
 1=>array(
  0=>array('name'=>'兵卒妖精', 'description'=>'递给妖精一只长枪就将它们送上战场，反正死了也能量产，再说它们也死不掉。'),
  1=>array('name'=>'兵卒人形', 'description'=>'比妖精的战斗力强一点，不过对上高级兵种还是很吃力。所幸还是很容易量产。'),
  2=>array('name'=>'土精人形', 'description'=>'看起来很笨重但是实际上很灵活的人形，不过一碰就散，要注意。'),
  3=>array('name'=>'城壁人形', 'description'=>'武装着双手剑的人形，战斗力平均好用。'),
  4=>array('name'=>'高级城壁人形', 'description'=>'在前一个版本的基础上进行上级召唤的产物。'),
  5=>array('name'=>'主教人形', 'description'=>'使用强力的魔法进行远程攻击，不过防御是软肋'),
  6=>array('name'=>'高级主教人形', 'description'=>'使用了精灵力量对主教人形进行加固，攻击和守备都有提升。'),
  7=>array('name'=>'骑士妖精', 'description'=>'速度很快的妖精，不过除了这一点也没啥其他优点了。'),
  8=>array('name'=>'骑士人形', 'description'=>'使用大剑的骑士人形，突击用。'),
  9=>array('name'=>'高级骑士人形', 'description'=>'使用了精灵力量对骑士人形进行加固，攻击和守备都有提升。'),
  10=>array('name'=>'侦察兵人形', 'description'=>'隐秘和欺骗的行家，间谍可以在敌人的后方造成巨大的破坏。'),
  11=>array('name'=>'动员兵', 'description'=>'也只能够和熊之类的东西玩玩了。'),
  12=>array('name'=>'佣兵', 'description'=>'比动员兵战斗力强，不过也就是这种程度。'),
  13=>array('name'=>'浪人', 'description'=>'走了千里路的自称战士。'),
  14=>array('name'=>'雇佣弓兵', 'description'=>'拿着弓箭的动员兵，至少能射下苹果'),
  15=>array('name'=>'游侠', 'description'=>'云游四方而行侠仗义是为游侠也。'),
  16=>array('name'=>'盗贼', 'description'=>'有价值的地方都会有他们的身影。'),
  17=>array('name'=>'防卫塔', 'description'=>'对英雄的伤害会随着攻击次数上升。'),
  18=>array('name'=>'城墙', 'description'=>'吃下吧，这是8000点LP的反弹伤害！')
 ),
 2=>array(
  0=>array('name'=>'民兵', 'description'=>'被穿上盔甲征召的平民，使用枪作为武器，战斗力普通。'),
  1=>array('name'=>'戟兵', 'description'=>'接受过训练等待部署的长枪兵，拥有优于前者的武器和护甲。'),
  2=>array('name'=>'游侠', 'description'=>'挥舞着双手剑的战士，牺牲了护甲换取灵活度。'),
  3=>array('name'=>'剑士', 'description'=>'武装着大剑和盾牌的剑士是军队的必要部分。'),
  4=>array('name'=>'精英战士', 'description'=>'接受高级训练使用着剑和盾牌的精英部队。'),
  5=>array('name'=>'弓箭手', 'description'=>'弓箭手远程攻击强劲，但是碰上强力兵种的时候贫弱的护甲就会变成软肋。'),
  6=>array('name'=>'长弓手', 'description'=>'长弓造成更高的伤害，并且他们换上了板甲，解决了护甲的问题。'),
  7=>array('name'=>'枪兵骑士', 'description'=>'骑在马上的枪兵。'),
  8=>array('name'=>'大剑骑士', 'description'=>'骑在马上的大剑兵。'),
  9=>array('name'=>'精英骑士', 'description'=>'受过训练的高级游侠骑士。'),
  10=>array('name'=>'间谍', 'description'=>'隐秘和欺骗的行家，间谍可以在敌人的后方造成巨大的破坏。'),
  11=>array('name'=>'动员兵', 'description'=>'也只能够和熊之类的东西玩玩了。'),
  12=>array('name'=>'佣兵', 'description'=>'比动员兵战斗力强，不过也就是这种程度。'),
  13=>array('name'=>'浪人', 'description'=>'走了千里路的自称战士。'),
  14=>array('name'=>'雇佣弓兵', 'description'=>'拿着弓箭的动员兵，至少能射下苹果'),
  15=>array('name'=>'游侠', 'description'=>'云游四方而行侠仗义是为游侠也。'),
  16=>array('name'=>'盗贼', 'description'=>'有价值的地方都会有他们的身影。'),
  17=>array('name'=>'防卫塔', 'description'=>'对英雄的伤害会随着攻击次数上升。'),
  18=>array('name'=>'城墙', 'description'=>'吃下吧，这是8000点LP的反弹伤害！')
//  0=>array('name'=>'Spearman', 'description'=>'A peasant behind armor, armed with a spear.'),
//  1=>array('name'=>'Pikeman', 'description'=>'Spearmen trained before being deployed, with better armor and a self improved spear.'),
//  2=>array('name'=>'Fencer', 'description'=>'Dual sword wielding warrior who sacrifices armor for agility.'),
//  3=>array('name'=>'Swordsman', 'description'=>'Trained in the use of the sword and shield, the Swordsman is the backbone of the army.'),
//  4=>array('name'=>'Knight', 'description'=>'Elite armored warrior trained in the use of the sword and shield.'),
//  5=>array('name'=>'Bowman', 'description'=>'Bowmen provide great ranged damage but lack the protection of plate armor.'),
//  6=>array('name'=>'Longbowman', 'description'=>'Longer bows make for greater damage while plate armor provides greater protection.'),
//  7=>array('name'=>'Mounted spearman', 'description'=>'A spearman on a horse.'),
//  8=>array('name'=>'Mounted swordsman', 'description'=>'A swordsman on a horse.'),
//  9=>array('name'=>'Mounted knight', 'description'=>'A knight on a horse.'),
//  10=>array('name'=>'Spy', 'description'=>'Trained in the arts of sneaking and deception spies are fast and deadly.'),
//  11=>array('name'=>'Militia', 'description'=>'When there are witches to be burned or rampant bears to be guided back to the forest.'),
//  12=>array('name'=>'Thug', 'description'=>'Reformed peasant. Because crime does pay. Sometimes. Not really.'),
//  13=>array('name'=>'Bandit', 'description'=>'Survive the road long enough and you become a bandit.'),
//  14=>array('name'=>'Militia bowman', 'description'=>'A peasant with a bow. Bring the apples.'),
//  15=>array('name'=>'Ranger', 'description'=>'When you live in the woods and you\'re not a bandit you\'re a ranger.'),
//  16=>array('name'=>'Thief', 'description'=>'They\'ll go there if there\'s something to pinch.'),
//  17=>array('name'=>'Tower', 'description'=>'Standing tall and proud.'),
//  18=>array('name'=>'Wall', 'description'=>'Between a rock and a hard place.')
 )
);
?>
---
layout: post
title: Analyzing 007 - Part 1 [DRAFT]
categories: [Game Theory]
---

Woohoo, first actual post! I'm just going to write up some of my thoughts on a game that my brother and I like to play: 007.

# Double-0 Seven

## What is 007? 

007 a game, named after the famous spy, that is essentially an upgraded, slightly more violent version of Rock Paper Scissors.

## The rules

Like in Rock Paper Scissors, 007 involves two players simultaneously choosing one of three possible moves and resolving combat each round, with rounds being played continuously until one person wins. But unlike Rock Paper Scissors, 007 has more complex rules, and involves some counters that carry on from one round to the next.

The three possible moves in 007 are:

1. 🛡: Shield. Blocks the gun.
2. 🔫: Gun. Consumes one ammo, defeats the opponent if played when they are reloading.
3. 🚰: Reload. Restores one ammo.

"Ammo" is a counter that starts at zero. Obviously, 🔫 cannot be played with zero ammo (this results in an automatic loss). Ammo carries over from one round to the next. For example, using 🚰 twice, in two different rounds, allows you to use 🔫 a maximum of two times, in two different rounds, before you must reload to use 🔫 again. 

## Example game

|Rd. #|Player 1 action|Player 1 ammo|Player 2 action|Player 2 ammo|
|-|-|-|-|-|
|1|🚰|1|🚰|1|
|2|🔫|0|🛡|1|
|3|🚰|1|🚰|2|
|4|🛡|1|🛡|2|
|2|🔫|0|🔫|1|
|5|🚰|1|🔫|0|

And thus, player 2 wins. 

## Extra

I think this game is quite fun to play when I'm bored and with a friend, especially when waiting in line for something. There are accompanying hand motions and chants (which do draw some eyebrows from others) but overall a more interesting, and maybe more strategic (we'll find out if that's really true) game than Rock Paper Scissors. 

## Issues

Now, there are a couple of issues with this base version of 007. 

The first is that the game has the potential to go on forever if one player simply uses 🛡 over and over again. This essientally renders that player invincible, no matter what the other player does. We can fix this by introducing a new rule: 

4. 🎈: Bomb. Consumes 5 ammo (a player must have at least 5 ammo to play this move), instantly defeats the other player (unless they both play 🎈, if so the game continues).

Well, 5 is just an arbitrary number, but I picked it because it's nice round number that's not too large.

In any case, this new rule invalidates the "turtling" strategy, because leaving the opponent unchecked for too long allows them to one-shot you. 

However, there is also a second issue with the game. Well, not quite an issue, but a segue into what I'm going to talk about next. Notice how it's always best to play 🚰 as the first action? After all, we cannot play 🔫 or 🎈 in the first move, and 🛡 is useless when the opponent cannot attack us with 🔫 or 🎈 either. 

Let's solidify this idea with \*gasp\* *mathematics*. But first, we must talk a bit about game theory. 

# Game Theory (or at least, what I'm going to cover in this post)

*Key term:* **Nash Equilibrium**

A Nash Equilibrium is essentially a "relative best strategy". Well, not quite, but this simple explanation will suffice. In a Nash Equilibrium strategy, no **one** player can improve their position by switching to a different move. If it is possible for multiple players collude together and change their moves for a better result, it doesn't prevent a strategy from being a Nash Equilibrium. We might talk about this more in the future, but we'll leave the explanation here for now. 

## Applying Nash Equilibrium

Let's take a look at a well-known example of a game theory problem. Two prisoners are captured by the police and ~~asked~~ forced to play a game (*Saw*, anyone?). 

The game is as follows: Each prisoner can choose to remain silent or to betray the other. 

- If both prisoners remain silent, they both serve one year in prison. 
- If one prisoner betrays while the other remains silent, the tattle gets off scot-free while the other prisoner is given the full 10 year sentence. 
- Finally, if both prisoners betray, they split the sentence equally, 5 years for both. 

We can draw a neat little table for the resulting sentence for each prisoner's choice. These tables are a good way to analyze games where the players' choices are made independently/simultaneously (such as in Rock Paper Scissors and 007—see where we're going with this?)

| P1 choice \ P2 choice | Silent | Betray |
|-|-|-|
|**Silent**|1 year \ 1 year| 10 years \ 0 years|
|**Betray**|0 years \ 10 years | 5 years \ 5 years|

As you can see, each box in the grid represents one possible strategy for the two players. Can you find the Nash Equilibrium?[^1]

Well, I claim that the Nash Equilibrium is when both prisoners betray. What? But if they both stay silent, it would be better for the both of them! The reason the Nash Equilibrium is at double betrayal is because, in this strategy, any one player choosing to stay silent instead will double their time in jail. Meanwhile, both players staying silent, while it is a utilitarian best option, is not an equilibrium, because any one player changing their choice to betrayal can get away without any sentence at all. 

Finally, one important fact is that there is not necessarily exactly one Nash Equilibrium: there could be multiple, or there could be none. 

With this new knowledge in mind, let's return to our games.

[^1]: Even better: can you devise a method to find the Nash Equilibria in any given outcome table?

# Rock Paper Scissors

First, we can try finding a Nash Equilibrium for Rock Paper Scissors. To do so, we have to assign some sort of value to each possible outcome of the game, just like the prisoners' sentences in the previous example. Let's say a win counts as +1, a loss counts as -1, and a draw results in 0. The values are arbitrary, as long as a win is better than a draw, which is further better than a loss. Now we can draw another grid, just like before. 

| P1 choice \ P2 choice | Rock | Paper | Scissors |
|-|:-:|:-:|:-:|
|**Rock**|0 \ 0| -1 \ +1| +1 \ -1|
|**Paper**| +1 \ -1|0 \ 0| -1 \ +1|
|**Scissors**| -1 \ +1| +1 \ -1| 0 \ 0|

Where is the Nash Equilibrium?

Weell, it was a trick question, there is no Nash Equilibrium in Rock Paper Scissors. We can show this more rigorously by considering any outcome of the game and noticing that at it is impossible for both players to be winning in that outcome, hence at least one of the players is not winning, and would be able to improve their result by changing their move to one that would win instead. Therefore, no outcome can be the Nash Equilibrium. 

This makes a lot of sense, since Rock Paper Scissors is meant to be a random game—there is no single "optimal" move to play. If there was a Nash equilibrium, all players would play that strategy every time, and the game would be quite boring.

But wait! We previously noticed that there does exist a optimal strategy for the first move in 007—could we then build a outcome table and find the Nash Equilibrium?

# Back to 007

Here's the outcome table:

| P1 choice \ P2 choice | 🚰 | 🔫/🎈 | 🛡 |
|-|:-:|:-:|:-:|
|**🚰**|+1 ammo \ +1 ammo| +1 ammo \ instant loss| +1 ammo \ nothing|
|**🔫/🎈**| instant loss \ +1 ammo |instant loss \ instant loss|instant loss \ nothing|
|**🛡**| nothing \ +1 ammo| nothing \ instant loss | nothing \ nothing|

Now looking at this table, we can see our suspicious confirmed. The 🚰 \🚰 strategy is a Nash Equilibrium, meaning that deviating from this strategy would only ever result in a worse outcome. 

\[POST UNDER CONSTRUCTION\]
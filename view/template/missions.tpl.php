<table>
	<thead>
		<tr>
			<th></th>
		<?php foreach(current($contractsMonsters) as $monsterID => $percentage) : ?>
			<th><?php echo $main->monsters[$monsterID]->name; ?></th>
		<?php endforeach; ?>
			<th>Countdown</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($contractsMonsters as $contractID => $monsters) : ?>
		<tr>
			<th><?php echo $main->contracts[$contractID]->city; ?></th>
		<?php foreach($monsters as $monsterID => $percentage) : ?>
			<td><a href="http://www.croquemonster.com/contract?cid=<?php echo $contractID; ?>;mid=<?php echo $monsterID; ?>"><?php echo $percentage; ?>%</a> (<span class="smallGold"><?php echo (int)($main->contracts[$contractID]->prize - (int)$main->monsters[$monsterID]->bounty); ?></span>)</td>
		<?php endforeach; ?>
			<td><?php echo (int)($main->contracts[$contractID]->countdown / 60); ?> min</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<template>
	<div class="pull-left company-title">
		{{ name }}
	</div>
</template>
<script>
export default {
	props : ['name']
}
</script>
<style>
@media screen and (min-width: 320px) and (max-width: 1024px) {
	.company-title {
		color: white; 
		font-size: 18px; 
		padding: 10px 10px; 
		width: 220px;
		text-align: center;
	}
	.tab-content, .box-body {
		overflow-x: auto;
	}
}
@media screen and (min-width: 375px)  and (max-width: 425px) {
	.company-title {
		color: white; 
		font-size: 20px; 
		padding: 10px 10px; 
		width: 270px;
		text-align: center;
	}
}
@media screen and (min-width: 425px)  and (max-width: 425px) {
	.company-title {
		color: white; 
		font-size: 20px; 
		padding: 10px 10px; 
		width: 320px;
		text-align: center;
	}
}
@media screen and (min-width: 1024px) {
	.company-title {
		color: white; 
		font-size: 20px; 
		padding: 10px 10px; 
		width: 700px;
	}
}
</style>
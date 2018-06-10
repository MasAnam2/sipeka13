<template>
	<ul class="sidebar-menu">
		<li class="header">MAIN NAVIGATION</li>
		<li v-for="menu in menus" :class="[activeModul.indexOf(menu.link) == 0 ? 'active' : '']">
			<a href="#" v-on:click.prevent="moveModul(menu.link, menu.text, menu.modul)">
				<i :class="menu.icon"></i><span> {{ menu.text }}</span>
			</a>
		</li>
	</ul>
</template>
<script>
export default {
	data(){
		return {
			menus : [],
			processingModul : false,
			modul : 'departments'
		}
	},
	computed : {
		activeModul : {
			get(){
				return this.modul
			},
			set(val){
				this.modul = val
			}
		},
	},
	methods : {
		moveModul(uri, title, modul){
			if(!this.processingModul){
				this.activeModul     = uri
				this.processingModul = true
				moveModul(uri, title, modul)
				this.processingModul = false
			}
		}
	},
	created(){
		axios.get(base_url('/api/setting/menus')).then(resp=>{
			this.menus = resp.data
		})
	},
	mounted(){
		this.modul = window.location.pathname
	},
}
</script>
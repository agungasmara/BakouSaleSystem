<template>
    <div v-bind:class="{ active: isActive }" class="loading">
        <!-- /.Fixed navbar  -->
        <div class="container main-container headerOffset">
            <div class="row">
                <h1>{{StateData.title}}</h1>
                <span v-html="StateData.description"></span>
            </div>
        </div>
    </div>  
    <!-- /main-container -->
</template>

<script>
    import InformationDataComponent from './../../../Components/frontend/information/_information_data.vue'
    import Flash from '../../../../helper/flash'
    import axios from 'axios'

    export default{
        props:['id'],
        data(){
            return{
                isActive: true,
                StateData:Flash.state,
                // informationInfo:[],
            }
        },
        ready: function () {    
            // alert("testig");
            // alert($route.params.id);
        },
        components:{    
            InformationDataComponent
        },
        mounted(){
            
        },
        created(){
            this.InformationDetails(this.id);
        },
        beforeUpdate(){
            var pid = this.$route.params.id;
            //Flash.setState(this.InformationDetails(pid));
        },
        methods:{
            InformationDetails(id){
                axios.get('/api/information/'+id).then(res=>{
                    this.StateData=res.data
                    this.isActive = !this.isActive
                    return false
                });
            }
        }
    }
</script>
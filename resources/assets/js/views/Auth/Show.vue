<template>
  <div>
    <form class="form" @submit.prevent="update">
      <ul v-if="recipe && recipe.length">
        <li v-for="credential of recipe">
          <div class="row" style="border:1px solid #f00;">
            <p><strong><input type="text" class="form__control" v-model="credential.id"></strong></p>
            <p><input type="text" class="form__control" v-model="credential.name"></p>
            <p>
              <!-- <input type="submit" class="btn btn-success" value="Update" name=""> -->
              <button :disabled="isProcessing" class="btn btn__primary">Update</button>
            </p>
            <p><a href="/"></a></p>
          </div><br/>
        </li>
      </ul>

      <ul v-if="errors && errors.length">
        <li v-for="error of errors">
          {{error.message}}
        </li>
      </ul>
    </form>
  </div>
</template>

<script type="text/javascript">
    // import Flash from '../../helper/flash'
    // import {post} from '../../helper/api'
    // import axios from 'axios'
    
    // export default {
    //   data() {
    //       return {
    //           form: {
    //             recipe: [],
    //             errors: [],
    //             name:'',
    //             id:'',
    //           },
    //           flash: Flash.state,
    //           error: Flash.state,
    //           isProcessing: false
    //       }
    //   },
    //   // Fetches posts when the component is created.
    //   created() {
    //     axios.get(`/api/show/${this.$route.params.id}`)
    //     .then(response => {
    //       // JSON responses are automatically parsed.
    //       this.recipe = response.data
    //       // console.log(response.data)
    //     })
    //     .catch(e => {
    //       this.errors.push(e)
    //     })
    //   },
    //   mounted: function () {
    //     console.log(this.$http);
    //   },
    //   ready() {
    //     this.form.email    = form.email;
    //     this.form.password = form.password;
    //     this.update();
    //   },
    //   methods: {
    //     update() {
    //       this.isProcessing = true
    //       this.error = {}
    //       post('/login', this.credential)
    //         .then((res) => {
    //             console.log(res);
    //         if(res.data.success) {
    //             Flash.setSuccess('Congratulations! You have now successfully modified.')
    //         }else{
    //             Flash.setError('Error while trying to update.')
    //         }
    //         this.isProcessing = false
    //       })
    //       .catch((err) => {
    //         if(err.response.status === 422) {
    //             this.error = err.response.data
    //         }
    //         Flash.setError('Error while trying to login.')
    //         this.isProcessing = false
    //       })
    //     }
    //   }
    // }
</script>

<script>
import Flash from '../../helper/flash'
import axios from 'axios';
import {post} from '../../helper/api'
export default {
  data() {
    return {
      credential: {
        id: '',
        name: ''
      },
      recipe: [],
      errors: [],
      isProcessing: false
    }
  },

  // Fetches posts when the component is created.
  created() {
    axios.get(`/api/show/${this.$route.params.id}`)
    // axios.get(`http://jsonplaceholder.typicode.com/posts`)
    // post('http://jsonplaceholder.typicode.com/posts', this.credential)
    .then(response => {
      // JSON responses are automatically parsed.
      this.recipe = response.data
      // console.log(response.data)
    })
    .catch(e => {
      this.errors.push(e)
    })
  },
  ready() {
      this.credential.id    = credential.id;
      this.credential.name = credential.name;
      this.update();
  },
  methods: {
    update() {
      var id = `${this.$route.params.id}`
      var name=this.credential.name
      axios.put('/api/update',{id:id,name:this.credential.name}).then((response) => {
        // commit('SET_USER_PROFILE', { profile: response.data })
        console.log(response.data)
      }, (err) => {
        console.log(err)
      })
      // // console.log(this.credential)
      // this.isProcessing = true
      // this.error = {}
      // axios.put(`/api/update/${this.$route.params.id}`, this.credential)
      //   .then((res) => {
      //       console.log(res);
      //   if(res.data.success) {
      //       Flash.setSuccess('Congratulations! You have now successfully modified.')
      //   }else{
      //       Flash.setError('Error while trying to update.')
      //   }
      //   this.isProcessing = false
      // })
      // .catch((err) => {
      //   if(err.response.status === 422) {
      //       this.error = err.response.data
      //   }
      //   Flash.setError('Error while trying to login.')
      //   this.isProcessing = false
      // })
    }
  }
}
</script>
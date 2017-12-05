<template>
    <div>
          <ul v-if="recipe && recipe.length">
            <li v-for="post of recipe">
              <div class="row" style="border:1px solid #f00;">
                <p><strong><input type="text" id="jack" v-model="post.id"></strong></p>
                <p><input type="text" id="jack" v-model="post.name"></p>
                <p><input type="submit" class="btn btn-success" value="Update" name=""></p>
                <p><a href="/"></a></p>
              </div><br/>
            </li>
          </ul>

          <ul v-if="errors && errors.length">
            <li v-for="error of errors">
              {{error.message}}
            </li>
          </ul>
            </div>
        </template>

<script>
import axios from 'axios';
import {post} from '../../helper/api'
export default {
  data() {
    return {
      recipe: [],
      errors: [],
      name:'',
      id:'',
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

    // async / await version (created() becomes async created())
    //
    // try {
    //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
    //   this.posts = response.data
    // } catch (e) {
    //   this.errors.push(e)
    // }
  }
}
</script>
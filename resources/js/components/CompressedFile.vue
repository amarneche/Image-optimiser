<template>

 <tr>


        <td>{{ name}} </td>
        <td> {{oldSizeFormatted}}</td>
        <td>{{newSizeFormatted}}</td>
        <td>{{ saving }}</td>

        <td>
            <div v-if="isCompressed" > 
                <a target="__blank" :href="viewUrl" class="btn btn-outlined-secondary">View </a>
                <button class="btn  btn-sm btn-danger" @click="download" >
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 13V17C19 17.5304 18.7893 18.0391 18.4142 18.4142C18.0391 18.7893 17.5304 19 17 19H3C2.46957 19 1.96086 18.7893 1.58579 18.4142C1.21071 18.0391 1 17.5304 1 17V13M5 8L10 13M10 13L15 8M10 13V1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg> 
                    Download 
                </button>
            </div>
            <div v-else >
               <div class="progress">
                <div class="progress-bar progress-bar-striped bg-danger " role="progressbar" :style="{width: progress + '%' }"  aria-valuemin="0" aria-valuemax="100">
                     {{progress}} % 
                </div>
                </div>
            </div>

        </td>
     </tr>
    


</template>



<script>

export default {
    mounted(){
        this.submit();
        this.oldSize=this.file.size;
        this.name=this.file.name;
    },
    data(){

        return {
            isCompressed:false,
            progress:0,
            exension: null,
            hashName: null,
            name: null,
            newSize: null,
            oldSize: null,
           
        }
    },
    computed :{
        saving(){
            if(this.newSize & this.oldSize){
                return Math.floor( this.newSize / this.oldSize *100 ) + '%';
            }
        },
        oldSizeFormatted(){
            if(this.oldSize)
                return this.convertToHumans(this.oldSize);
        },
        newSizeFormatted(){
            if(this.newSize)
                return this.convertToHumans(this.newSize);
        },
        savingFormatted(){
            if(this.newSize && this.oldSize){
                if(this.oldSize > this.newSize){
                    return this.convertToHumans( this.oldSize-this.newSize );
                }
            }
        },
        viewUrl(){
            return "storage/"+this.hashName;
        }



    }
    ,
    props :['file','quality','format' ],
    methods: {
        convertToHumans(size){
            let units=['B','KB','MB','GB'];
            let exponent= this.getBaseLog(size,1024);
            console.log(exponent);
            console.log(size);
            
            return Math.fround(size/Math.pow(1024,exponent)).toFixed(2) + " " + units[exponent] ;

        }, 
        getBaseLog(x,y){
            return Math.floor(Math.log(x)/Math.log(y));
        }
        ,
        submit(){
           
            if(this.format && this.quality){

                let fd= new FormData;
                fd.append("files[0]", this.file);
                fd.append("format", this.format);
                fd.append("quality", this.quality);

                axios.post("/api/compress/", fd ,{
                    onUploadProgress: progressEvent=>  this.progress =Math.round((progressEvent.loaded * 100) / progressEvent.total)
                } )
                .then( (res)=>{
                    this.isCompressed=true;
                    this.name= res.data.response[0].name;
                    this.exension= res.data.response[0].exension;
                    this.hashName= res.data.response[0].hashName;
                    this.newSize= res.data.response[0].newSize;
                    
                    console.log(res);
                } )
                .catch((err)=>{

                } )


            }
            return false;
        },
        download(){
            axios.get(`/storage/${this.hashName}`, {responseType: 'blob'} )
            .then((res)=>{
               console.log(res);
               let url = window.URL.createObjectURL( new Blob([res.data]));
               let link = document.createElement('a');
               link.href=url;
               link.setAttribute("download",this.name);
               link.click();
            } )
            .catch((err)=>{
                console.log(err);
            });
        }
    }
   

}
</script>
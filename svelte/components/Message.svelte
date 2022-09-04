<Breadcrumb noTrailingSlash>
    <BreadcrumbItem>
        <Link to="/">All Messages</Link>
    </BreadcrumbItem>
    <BreadcrumbItem isCurrentPage>Message</BreadcrumbItem>
</Breadcrumb>

<Tile light>
    <h1 class="header"> Message [ { messageSid } ]</h1>

    {#if isLoading}
        <SkeletonText paragraph lines={10}/>
    {:else }
        <Accordion>
            <AccordionItem open>
                <svelte:fragment slot="title">
                    <h2>Overview</h2>
                </svelte:fragment>
                <h3>Sender</h3>
                <p class="detail">{getPhoneNumber(message.from)}</p>
                <h3>Recipient</h3>
                <p class="detail">{getPhoneNumber(message.to)}</p>
                <h3>Message</h3>
                <p class="detail">{message.body}</p>
                <h3>Status</h3>
                <p class="detail">{message.status}</p>
                <h3>Segments</h3>
                <p class="detail">{message.numSegments}</p>
                <h3>Price</h3>
                <p class="detail">{message.price} ({message.priceUnit})</p>
                <h3>Medium</h3>
                <p class="detail">{getMedium()}</p>
            </AccordionItem>
            <AccordionItem>
                <svelte:fragment slot="title">
                    <h2>Timeline</h2>
                </svelte:fragment>
                <h3>Created</h3>
                <p class="detail">{getFormattedDate(message.dateCreated)}</p>
                <h3>Sent</h3>
                <p class="detail">{getFormattedDate(message.dateSent)}</p>
                <h3>Updated</h3>
                <p class="detail">{getFormattedDate(message.dateUpdated)}</p>
            </AccordionItem>
        </Accordion>

        <DeleteMessage
                messageSid={messageSid}
                showAsIcon={false}
                on:delete={handleDelete}
        />
    {/if}
</Tile>

<style>
    .header {
        text-align: center;
        padding: 10px;
    }

    .detail {
        margin-bottom: 20px;
    }
</style>

<script>
    import {Accordion, AccordionItem, Breadcrumb, BreadcrumbItem, SkeletonText, Tile} from "carbon-components-svelte";
    import {Link, navigate} from "svelte-routing";
    import {getMessage} from "../Api";
    import {onMount} from "svelte";
    import DeleteMessage from "./DeleteMessage.svelte";

    export let messageSid;
    let isLoading = true;
    let message = null;

    onMount(async () => {
        message = await getMessage(messageSid);
        isLoading = false;
    });

    const handleDelete = () => {
        navigate("/", {replace: true});
    }

    const getFormattedDate = dateObject => {
        const {date} = dateObject;
        const options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric"
        };
        return new Date(date).toLocaleTimeString("en-US", options)
    }
    const getMedium = () => {
        const medium = message.from.split(":")[0];
        return `${medium.charAt(0).toUpperCase()}${medium.slice(1)}`;
    }

    const getPhoneNumber = phoneNumber => phoneNumber.split(":")[1];
</script>
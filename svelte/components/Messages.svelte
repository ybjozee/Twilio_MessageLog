{#if isLoading}
    <DataTableSkeleton showHeader={false} showToolbar={false}/>
{:else }
    <Tile>
        {#if showDeleteNotification}
            <div class="notification-container">
                <InlineNotification
                        lowContrast
                        kind="success"
                        title="Success"
                        subtitle="Message deleted successfully"
                />
            </div>
        {/if}
        <DataTable
                zebra
                sortable
                {pageSize}
                {page}
                headers={tableHeaders}
                rows={messages}
                title="Twilio Message Logs"
                description="All the messages in your Twilio logs"
        >
            <svelte:fragment slot="cell" let:row let:cell>
                {#if cell.key === "sid"}
                    <div class="sid-container">
                        <Link to={`message/${cell.value}`}>
                            {cell.value}
                        </Link>
                        <DeleteMessage
                                messageSid={cell.value}
                                showAsIcon={true}
                                on:delete={handleDelete}
                        />
                    </div>

                {:else}
                    {cell.value}
                {/if}
            </svelte:fragment>
            <Toolbar>
                <ToolbarContent>
                    <ToolbarSearch
                            persistent
                            value=""
                            shouldFilterRows
                            bind:filteredRowIds
                    />
                </ToolbarContent>
            </Toolbar>
        </DataTable>
        <Pagination
                bind:pageSize
                bind:page
                totalItems={messages.length}
                pageSizeInputDisabled
        />
    </Tile>
{/if}

<style>
    .notification-container {
        display: flex;
        width: 100%;
        justify-content: end;
        align-items: end;
    }

    .sid-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
<script>
    import {
        DataTable,
        DataTableSkeleton,
        InlineNotification,
        Pagination,
        Tile,
        Toolbar,
        ToolbarContent,
        ToolbarSearch,
    } from "carbon-components-svelte";
    import {getMessages} from "../Api.js";
    import {onMount} from "svelte";
    import {Link} from "svelte-routing";
    import DeleteMessage from "./DeleteMessage.svelte";

    let pageSize = 10;
    let page = 1;
    let isLoading = true;
    let showDeleteNotification = false;
    let messages = [];
    let filteredRowIds = [];

    const tableHeaders = [
        {key: "body", value: "Message"},
        {key: "direction", value: "Direction"},
        {key: "price", value: "Price"},
        {key: "status", value: "Status"},
        {key: "sid", value: "MessageSid"}
    ];

    onMount(async () => {
        messages = await getMessages();
        isLoading = false;
    })

    const handleDelete = (event) => {
        showDeleteNotification = true;
        setTimeout(() => {
            showDeleteNotification = false;
        }, 3000);
        const messageSid = event.detail.messageSid;
        messages = messages.filter(({sid}) => sid !== messageSid);
    }
</script>